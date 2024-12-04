const grid = document.getElementById('dashboard-grid');
const cells = document.querySelectorAll('.grid-item');
const toolboxElement = document.getElementById('draggable');

let dragElement = undefined;

// Setting up event listeners
toolboxElement.addEventListener("dragstart", dragStart);
toolboxElement.addEventListener("dragend", dragEnd);

cells.forEach(cell => {
    cell.addEventListener("dragover", dragOver)
    cell.addEventListener("dragenter", dragEnter);
    cell.addEventListener("dragleave", dragLeave);
    cell.addEventListener("drop", dragDrop);
    cell.addEventListener("dragend", dragEnd);
});


function dragStart(e) {
    if(e.target != null) {
        dragElement = e.target;
    }
}

function dragOver(e) {
    if(dragElement != undefined) {
        e.preventDefault();
    }
}

function dragEnter(e) {
    if(dragElement != undefined) {
        e.target.classList.add("highlight");
        console.log("Can add", dragElement, "to the box");
    }
}

function dragLeave(e) {
    e.target.classList.remove("highlight");
}

function dragDrop(e) {
    if(dragElement != undefined){
        e.target.append(dragElement);
        dragElement.style.height = "100%";
        dragElement.style.width = "100%";
        e.target.classList.remove("highlight");
    }
}

function dragEnd() {
    dragElement = undefined;
}