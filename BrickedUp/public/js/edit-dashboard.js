//#region Setting up variables and event listeners
const grid = document.getElementById("dashboard-grid");
const toolbox = document.getElementById("toolbox");
const toolboxItems = document.querySelectorAll(".modular-element");
const cellWidth = grid.clientWidth / 10;
const cellHeight = grid.clientHeight / 5;
let dashboardLayout = Array.from({length: 5}, () => Array(10).fill(""));
const ResizeDirections = {
    UP: 1,
    RIGHT: 2,
    DOWN: 3,
    LEFT: 4, 
    NONE: 5
};

class ModularElement {
    constructor(elementReference) {
        this.id = 0;
        this.ref = elementReference;
        // coordinates on the grid
        this.columnStart = 0;
        this.columnEnd = 0;
        this.rowStart = 0;
        this.rowEnd = 0;
        // last coordinates for grid cleanup
        this.lastColumnStart = -1;
        this.lastColumnEnd = -1;
        this.lastRowStart = -1;
        this.lastRowEnd = -1;
        // resize elements
        this.resizeUp = undefined;
        this.resizeDown = undefined;
        this.resizeRight = undefined;
        this.resizeLeft = undefined;
    }

    updatePosition(newRowStart, newRowEnd, newColumnStart, newColumnEnd) {
        this.rowStart = newRowStart;
        this.rowEnd = newRowEnd;
        this.columnStart = newColumnStart;
        this.columnEnd = newColumnEnd;
    }

    updateLastPosition(lastRowStart, lastRowEnd, lastColumnStart, lastColumnEnd) {
        this.lastRowStart = lastRowStart;
        this.lastRowEnd = lastRowEnd;
        this.lastColumnStart = lastColumnStart;
        this.lastColumnEnd = lastColumnEnd;
    }

    clearLastPosition() {
        this.lastRowStart = -1;
        this.lastRowEnd = -1;
        this.lastColumnStart = -1;
        this.lastColumnEnd = -1;
    }
}

let modularElements = [];
toolboxItems.forEach(item => {
    let index = modularElements.push(new ModularElement(item)) - 1;
    modularElements[index].id = item.id;
    modularElements[index].ref.addEventListener("dragstart", (e) => dragStart(e, modularElements[index]));
    modularElements[index].ref.addEventListener("dragend", dragEnd);

    modularElements[index].resizeUp = item.querySelector(".resize-up");
    modularElements[index].resizeUp.addEventListener("dragstart", (e) => startResize(e, modularElements[index], ResizeDirections.UP));
    modularElements[index].resizeUp.addEventListener("dragend", stopResize);

    modularElements[index].resizeDown = item.querySelector(".resize-down");
    modularElements[index].resizeDown.addEventListener("dragstart", (e) => startResize(e, modularElements[index], ResizeDirections.DOWN));
    modularElements[index].resizeDown.addEventListener("dragend", stopResize);

    modularElements[index].resizeRight = item.querySelector(".resize-right");
    modularElements[index].resizeRight.addEventListener("dragstart", (e) => startResize(e, modularElements[index], ResizeDirections.RIGHT));
    modularElements[index].resizeRight.addEventListener("dragend", stopResize);

    modularElements[index].resizeLeft = item.querySelector(".resize-left");
    modularElements[index].resizeLeft.addEventListener("dragstart", (e) => startResize(e, modularElements[index], ResizeDirections.LEFT));
    modularElements[index].resizeLeft.addEventListener("dragend", stopResize);
})


let beingDragged = new ModularElement(undefined);
let beingResized = new ModularElement(undefined);
let resizeDirection = ResizeDirections.NONE;

const highlightElement = document.createElement("div");
highlightElement.className = "highlighted-cell";
let highlightCellReference = undefined;

toolbox.addEventListener("dragenter", highlightToolbox);
toolbox.addEventListener("dragleave", unhighlightToolbox);
toolbox.addEventListener("dragover", dragOverToolbox)
toolbox.addEventListener("drop", appendToToolbox);

grid.addEventListener("dragenter", gridEnter);
grid.addEventListener("dragleave", gridLeave);
grid.addEventListener("dragover", getElementPosition);
grid.addEventListener("drop", gridDrop);

//#endregion

//#region Modular Element Callback Functions
function dragStart(e, modular) {
    if(e.target != null) {
        beingDragged = modular;
        beingDragged.updateLastPosition(beingDragged.rowStart, beingDragged.rowEnd, beingDragged.columnStart, beingDragged.columnEnd);
    }
}

function dragEnd() {
    if(beingDragged != undefined) {
        clearGrid(beingDragged.lastRowStart, beingDragged.lastRowEnd, beingDragged.lastColumnStart, beingDragged.lastColumnEnd);
        beingDragged.clearLastPosition(); // so that the element does not clear its current position in the future
        setGrid(beingDragged.id, beingDragged.rowStart, beingDragged.rowEnd, beingDragged.columnStart, beingDragged.columnEnd);
        beingDragged = undefined;
    }
}

function startResize(e, modular, direction) {
    if(e.target != null) {
        e.stopPropagation();
        resizeDirection = direction;
        beingResized = modular;
        beingResized.updateLastPosition(beingResized.rowStart, beingResized.rowEnd, beingResized.columnStart, beingResized.columnEnd);
    }
}

function stopResize() {
    if(beingResized != null) {
        beingResized.clearLastPosition();
        resizeDirection = ResizeDirections.NONE;
        beingResized = undefined;
    }
}

function resizeUp(e, modular) {
    if(e.target != null && modular.rowStart > 1) {
        modular.rowStart -= 1;
        modular.ref.style.gridRow = `${modular.rowStart} / ${modular.rowEnd}`;
    }
}

function resizeDown(e, modular) {
    if(e.target != null && modular.rowEnd < 6) {
        modular.rowEnd += 1;
        modular.ref.style.gridRow = `${modular.rowStart} / ${modular.rowEnd}`;
    }
}

function resizeLeft(e, modular) {
    if(e.target != null && modular.columnEnd < 11) {
        modular.columnEnd += 1;
        modular.ref.style.gridColumn = `${modular.columnStart} / ${modular.columnEnd}`;
    }
}

function resizeRight(e, modular) {
    if(e.target != null && modular.columnStart > 1) {
        modular.columnStart -= 1;
        modular.ref.style.gridColumn = `${modular.columnStart} / ${modular.columnEnd}`;
    }
}

//#endregion

//#region Toolbox Callback Functions
function highlightToolbox(e) {
    if(e != null && beingDragged != undefined && !e.target.contains(beingDragged.ref)) {
        e.target.classList.add("highlight-toolbox");
    }
}

function unhighlightToolbox(e) {
    if(e != null) {
        e.target.classList.remove("highlight-toolbox");
    }
}

function dragOverToolbox(e) {
    if(e.target != null && beingDragged.ref != undefined)  {
        e.preventDefault();
    }
}

function appendToToolbox(e) {
    if(beingDragged != undefined && !e.target.contains(beingDragged.ref)) {
        e.target.append(beingDragged.ref);
        beingDragged.ref.classList.remove("grid-item");
        beingDragged.ref.classList.add("toolbox-item");
        unhighlightToolbox(e);
    }
}

//#endregion

//#region Grid Callback Functions
function getElementPosition(e) {
    if(e.target != null && resizeDirection == ResizeDirections.NONE) {
        e.preventDefault();
        const rect = grid.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        let newRowStart = Math.floor(y / cellHeight) + 1;
        let newRowEnd = newRowStart + Math.max(1, beingDragged.rowEnd - beingDragged.rowStart)
        let newColumnStart = Math.floor(x / cellWidth) + 1;
        let newColumnEnd = newColumnStart + Math.max(1, beingDragged.columnEnd - beingDragged.columnStart); 

        beingDragged.updatePosition(newRowStart, newRowEnd, newColumnStart, newColumnEnd);

        // update the highlight element position or create it if it does not exist
        if(highlightCellReference != undefined) {
            highlightCellReference.style.gridRow = `${beingDragged.rowStart} / ${beingDragged.rowEnd}`;
            highlightCellReference.style.gridColumn = `${beingDragged.columnStart} / ${beingDragged.columnEnd}`;
        }
        else {
            gridEnter();
        }
    }
    else if(resizeDirection != ResizeDirections.NONE) {
        e.preventDefault();
        // Find which cell the cursor is on
        const rect = grid.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        let cursorRow = Math.floor(y / cellHeight) + 1;
        let cursorColumn = Math.floor(x / cellWidth) + 1;

        let newRowStart = beingResized.rowStart;
        let newRowEnd = beingResized.rowEnd;
        let newColumnStart = beingResized.columnStart;
        let newColumnEnd = beingResized.columnEnd;
        
        switch(resizeDirection) {
            case ResizeDirections.UP:
                if(cursorRow < beingResized.rowEnd) {
                    newRowStart = cursorRow;
                } 
                break;
            case ResizeDirections.DOWN:
                cursorRow+=1;
                if(cursorRow > beingResized.rowStart) {
                    newRowEnd = cursorRow;
                } 
                break;
            case ResizeDirections.RIGHT:
                cursorColumn+=1;
                if(cursorColumn > beingResized.columnStart) {
                    newColumnEnd = cursorColumn;
                } 
                break;
            case ResizeDirections.LEFT:
                if(cursorColumn < beingResized.columnEnd) {
                    newColumnStart = cursorColumn;
                } 
                break;
            default:
                break;
        }
        
        if(checkGrid(beingResized.id, newRowStart, newRowEnd, newColumnStart, newColumnEnd)) {
            // Updating the grid data structure
            beingResized.updatePosition(newRowStart, newRowEnd, newColumnStart, newColumnEnd);
            clearGrid(beingResized.lastRowStart, beingResized.lastRowEnd, beingResized.lastColumnStart, beingResized.lastColumnEnd);
            setGrid(beingResized.id, beingResized.rowStart, beingResized.rowEnd, beingResized.columnStart, beingResized.columnEnd);
            // Setting the actual position on the page
            beingResized.ref.style.gridRow = `${beingResized.rowStart} / ${beingResized.rowEnd}`;
            beingResized.ref.style.gridColumn = `${beingResized.columnStart} / ${beingResized.columnEnd}`;
        }
    }
}

function gridEnter() {
    // add the highlight element to the grid
    if(beingDragged != undefined && !grid.contains(highlightCellReference) && resizeDirection == ResizeDirections.NONE) {
        grid.appendChild(highlightElement);
        highlightCellReference = document.querySelector(".highlighted-cell")
    }
}

function gridLeave() {
    // remove the highlighted element from the grid
    if(highlightCellReference != undefined && grid.contains(highlightCellReference) && resizeDirection == ResizeDirections.NONE) {
        grid.removeChild(highlightCellReference);
        highlightCellReference = undefined;
    }
}

function gridDrop() {
    if(beingDragged != undefined && resizeDirection == ResizeDirections.NONE) {
        if(checkGrid(beingDragged.id, beingDragged.rowStart, beingDragged.rowEnd, beingDragged.columnStart, beingDragged.columnEnd)) {
            grid.append(beingDragged.ref);
            beingDragged.ref.classList.remove("toolbox-item");
            beingDragged.ref.classList.add("grid-item");
            beingDragged.ref.style.gridColumn = `${beingDragged.columnStart} / ${beingDragged.columnEnd}`;
            beingDragged.ref.style.gridRow = `${beingDragged.rowStart} / ${beingDragged.rowEnd}`;
        }
        else {
            // reset the position of the element
            beingDragged.updatePosition(beingDragged.lastRowStart, beingDragged.lastRowEnd, beingDragged.lastColumnStart, beingDragged.lastColumnEnd);
        }
    } 
    // for removing the highlight element
    gridLeave()
}

//#endregion

//#region Utility Functions

function printGrid() {
    for(let i=0; i<5; i++) {
        console.log(`${i+1}: ${dashboardLayout[i][0] == "" ? 0 : dashboardLayout[i][0]}, ${dashboardLayout[i][1] == "" ? 0 : dashboardLayout[i][1]}, ${dashboardLayout[i][2] == "" ? 0 : dashboardLayout[i][2]}, ${dashboardLayout[i][3] == "" ? 0 : dashboardLayout[i][3]}, ${dashboardLayout[i][4] == "" ? 0 : dashboardLayout[i][4]}`);
    }
}

function checkGrid(id, rowStart, rowEnd, colStart, colEnd) {
    if(rowStart <= 0 || colStart <= 0 || rowEnd > 6 || colEnd > 11) return false;
    for(let i = rowStart-1; i < rowEnd-1; i++) {
        for(let j = colStart-1; j < colEnd-1; j++) {
            if(dashboardLayout[i][j] !== "" && dashboardLayout[i][j] !== id) {
                return false;
            }
        }
    }
    return true;
}

function setGrid(id, rowStart, rowEnd, colStart, colEnd) {
    for(let i = rowStart-1; i < rowEnd-1; i++) {
        for(let j = colStart-1; j < colEnd-1; j++) {
            dashboardLayout[i][j] = id;
        }
    }
}

function clearGrid(rowStart, rowEnd, colStart, colEnd) {
    setGrid("", rowStart, rowEnd, colStart, colEnd);
}

//#endregion