const grid = document.getElementById('dashboard-grid');
const toolbox = document.getElementById('toolbox')
const toolboxElement = document.getElementById('draggable');
const cellWidth = grid.clientWidth / 10;
const cellHeight = grid.clientHeight / 5;

class ModularElement {
    constructor(elementReference) {
        this.ref = elementReference;
        // coordinates on the grid
        this.columnStart = 0;
        this.columnEnd = 0;
        this.rowStart = 0;
        this.rowEnd = 0;
        // resize elements
        this.resizeUp = undefined;
        this.resizeDown = undefined;
        this.resizeRight = undefined;
        this.resizeLeft = undefined;
    }
}

const modular = new ModularElement(toolboxElement);
modular.columnStart = 2;
modular.columnEnd = 3;
modular.rowStart = 2;
modular.rowEnd = 3;
modular.resizeUp = toolboxElement.querySelector(".resize-up");
modular.resizeDown = toolboxElement.querySelector(".resize-down");
modular.resizeRight = toolboxElement.querySelector(".resize-right");
modular.resizeLeft = toolboxElement.querySelector(".resize-left");

let beingDragged = new ModularElement(undefined);

const highlightElement = document.createElement("div");
highlightElement.className = "highlighted-cell";
let highlightCellReference = undefined;

//#region Setting up event listeners
toolbox.addEventListener("dragenter", highlightToolbox);
toolbox.addEventListener("dragleave", unhighlightToolbox);
toolbox.addEventListener("dragover", dragOverToolbox)
toolbox.addEventListener("drop", appendToToolbox)

modular.ref.addEventListener("dragstart", (e) => dragStart(e, modular));
modular.ref.addEventListener("dragend", dragEnd);
modular.resizeUp.addEventListener("click", (e) => resizeUp(e, modular));
modular.resizeDown.addEventListener("click", (e) => resizeDown(e, modular));
modular.resizeRight.addEventListener("click", (e) => resizeRight(e, modular));
modular.resizeLeft.addEventListener("click", (e) => resizeLeft(e, modular));

grid.addEventListener("dragenter", gridEnter);
grid.addEventListener("dragleave", gridLeave);
grid.addEventListener("dragover", getElementPosition);
grid.addEventListener("drop", gridDrop);
//#endregion

//#region Modular Element Callback Functions
function dragStart(e, modularRef) {
    if(e.target != null) {
        beingDragged = modularRef;
        console.log(beingDragged.rowEnd)
    }
}

function dragEnd() {
    beingDragged = undefined;
}

function resizeUp(e, modularRef) {
    if(e.target != null && modularRef.rowStart > 1) {
        modularRef.rowStart -= 1;
        modularRef.ref.style.gridRow = `${modularRef.rowStart} / ${modularRef.rowEnd}`;
    }
}

function resizeDown(e, modularRef) {
    if(e.target != null && modularRef.rowEnd < 6) {
        modularRef.rowEnd += 1;
        modularRef.ref.style.gridRow = `${modularRef.rowStart} / ${modularRef.rowEnd}`;
    }
}

function resizeLeft(e, modularRef) {
    if(e.target != null && modularRef.columnEnd < 11) {
        modularRef.columnEnd += 1;
        modularRef.ref.style.gridColumn = `${modularRef.columnStart} / ${modularRef.columnEnd}`;
    }
}

function resizeRight(e, modularRef) {
    if(e.target != null && modularRef.columnStart > 1) {
        modularRef.columnStart -= 1;
        modularRef.ref.style.gridColumn = `${modularRef.columnStart} / ${modularRef.columnEnd}`;
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
    if(e.target != null) {
        e.preventDefault();
        const rect = grid.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        let newRowStart = Math.floor(y / cellHeight) + 1;
        let newRowEnd = newRowStart + Math.max(1, beingDragged.rowEnd - beingDragged.rowStart)
        let newColumnStart = Math.floor(x / cellWidth) + 1;
        let newColumnEnd = newColumnStart + Math.max(1, beingDragged.columnEnd - beingDragged.columnStart); 

        beingDragged.rowStart = newRowStart;
        beingDragged.rowEnd = newRowEnd;
        beingDragged.columnStart = newColumnStart;
        beingDragged.columnEnd = newColumnEnd;
        console.log(`The mouse is over the cell at coordinates (${beingDragged.rowStart}, ${beingDragged.columnStart})`);

        // update the highlight element position or create it if it does not exist
        if(highlightCellReference != undefined) {
            highlightCellReference.style.gridRow = `${beingDragged.rowStart} / ${beingDragged.rowEnd}`;
            highlightCellReference.style.gridColumn = `${beingDragged.columnStart} / ${beingDragged.columnEnd}`;
        }
        else {
            gridEnter();
        }
    }
}

function gridEnter() {
    // add the highlight element to the grid
    if(beingDragged != undefined && !grid.contains(highlightCellReference)) {
        grid.appendChild(highlightElement);
        highlightCellReference = document.querySelector(".highlighted-cell")
    }
}

function gridLeave() {
    // remove the highlighted element from the grid
    if(highlightCellReference != undefined && grid.contains(highlightCellReference)) {
        grid.removeChild(highlightCellReference);
        highlightCellReference = undefined;
    }
}

function gridDrop() {
    if(beingDragged != undefined) {
        if(beingDragged.rowStart >= 0 && beingDragged.columnStart >= 0 && beingDragged.rowEnd <= 6 && beingDragged.columnEnd <= 11) {
            grid.append(beingDragged.ref);
    
            beingDragged.ref.classList.remove("toolbox-item");
            beingDragged.ref.classList.add("grid-item");
    
            beingDragged.ref.style.gridColumn = `${beingDragged.columnStart} / ${beingDragged.columnEnd}`;
            beingDragged.ref.style.gridRow = `${beingDragged.rowStart} / ${beingDragged.rowEnd}`;
        }
    } 
    // for removing the highlight element
    gridLeave()
}

//#endregion