const grid = document.getElementById('dashboard-grid');
const toolbox = document.getElementById('toolbox')
const toolboxElement = document.getElementById('draggable');
const cellWidth = grid.clientWidth / 10;
const cellHeight = grid.clientHeight / 5;

class ModularElement {
    constructor(elementReference) {
        this.ref = elementReference;
        // coordinates on the grid
        this.columnStart = -1;
        this.columnEnd = -1;
        this.rowStart = -1;
        this.rowEnd = -1;
        // resize elements
        this.resizeUp = undefined;
        this.resizeDown = undefined;
        this.resizeRight = undefined;
        this.resizeLeft = undefined;
    }
}

let dragElement = undefined;
let dragElementColumn = -1;
let dragElementRow = -1;
let lastElementColumn = -1;
let lastElementRow = -1;

const highlightElement = document.createElement("div");
highlightElement.className = "highlighted-cell";
let highlightCellReference = undefined;

//#region Setting up event listeners
toolbox.addEventListener("dragenter", highlightToolbox);
toolbox.addEventListener("dragleave", unhighlightToolbox);
toolbox.addEventListener("dragover", dragOverToolbox)
toolbox.addEventListener("drop", appendToToolbox)

toolboxElement.addEventListener("dragstart", dragStart);
toolboxElement.addEventListener("dragend", dragEnd);

grid.addEventListener("dragenter", gridEnter);
grid.addEventListener("dragleave", gridLeave);
grid.addEventListener("dragover", getElementPosition);
grid.addEventListener("drop", gridDrop);
//#endregion

//#region Toolbox Callback Functions
function highlightToolbox(e) {
    if(e != null && dragElement != undefined && !e.target.contains(dragElement)) {
        e.target.classList.add("highlight-toolbox");
    }
}

function unhighlightToolbox(e) {
    if(e != null) {
        e.target.classList.remove("highlight-toolbox");
    }
}

function dragOverToolbox(e) {
    if(e.target != null && dragElement != undefined)  {
        e.preventDefault();
    }
}

function appendToToolbox(e) {
    if(dragElement != undefined && !e.target.contains(dragElement)) {
        e.target.append(dragElement);
        dragElement.classList.remove("grid-item");
        dragElement.classList.add("toolbox-item");
        unhighlightToolbox(e);
    }
}

//#endregion

//#region Toolbox Element Callback Functions
function dragStart(e) {
    if(e.target != null) {
        dragElement = e.target;
    }
}

function dragEnd() {
    dragElement = undefined;
}

//#endregion

//#region Grid Callback Functions
function getElementPosition(e) {
    if(e.target != null) {
        e.preventDefault();
        const rect = grid.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        dragElementColumn = Math.floor(x / cellWidth);
        dragElementRow = Math.floor(y / cellHeight);
        console.log(`The element is at position: X=${x}, Y=${y} within the grid element`);
        console.log(`The element is over the cell at coordinates (${dragElementRow}, ${dragElementColumn})`);

        // update the highlight element position or create it if it does not exist
        if(highlightCellReference != undefined) {
            highlightCellReference.style.gridColumn = `${dragElementColumn+1} / ${dragElementColumn+1}`;
            highlightCellReference.style.gridRow = `${dragElementRow+1} / ${dragElementRow+1}`;
        }
        else {
            gridEnter();
        }
    }
}


function gridEnter() {
    // add the highlight element to the grid
    if(dragElement != undefined) {
        grid.appendChild(highlightElement);
        highlightCellReference = document.querySelector(".highlighted-cell")
    }
}

function gridLeave() {
    // remove the highlighted element from the grid
    if(highlightCellReference != undefined) {
        grid.removeChild(highlightCellReference);
        highlightCellReference = undefined;
    }
}

function gridDrop(e) {
    if(dragElement != undefined && dragElementColumn >= 0 && dragElementRow >= 0) {
        e.target.append(dragElement);

        dragElement.classList.remove("toolbox-item");
        dragElement.classList.add("grid-item");

        dragElement.style.gridColumn = `${dragElementColumn+1} / ${dragElementColumn+1}`;
        dragElement.style.gridRow = `${dragElementRow+1} / ${dragElementRow+1}`;

        // for removing the highlight element
        gridLeave()
    }
}

//#endregion


const resizeTest = document.querySelector(".resize-up");
resizeTest.addEventListener("click", () => {
    console.log("o", dragElementColumn);
    let temp = document.getElementById("draggable");
    temp.style.gridRow = `1 / 3`; 
})