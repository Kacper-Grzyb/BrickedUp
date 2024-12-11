let sidescroller = document.getElementById('sidescroller');
let sidescrollerElements = document.querySelectorAll('.sidescroller-box');
let elementOffsetsX = [];
let startingPositions = [];
let scrollSpeed = 1;

// calculate the screenBorder
let screenBorder = document.querySelector('.set-prices-sidescroller').scrollWidth - sidescrollerElements[0].offsetWidth;

// initialize the elementOffsetsX and startingPositions array
for(let i=0; i<sidescrollerElements.length; i++) {
    elementOffsetsX[i] = 0;
    let rect = sidescrollerElements[i].getBoundingClientRect();
    startingPositions[i] = rect.x;
}


function moveElement(index) {
    elementOffsetsX[index] += scrollSpeed;
    let transform = `translate(${elementOffsetsX[index]}px, 0px)`;
    sidescrollerElements[index].style.transform = transform;
}

function checkBoundaries(index) {
    let rect = sidescrollerElements[index].getBoundingClientRect();
    if(rect.left >= screenBorder) {
        // reset element to the left side of the screen
        let newOffsetX = (startingPositions[index] + sidescrollerElements[index].offsetWidth) * (-1);
        elementOffsetsX[index] = newOffsetX
    }
}

function animate() {
    for(let i=0; i<sidescrollerElements.length; i++) {
        moveElement(i);
        checkBoundaries(i);
    }

    requestAnimationFrame(animate);
}

animate();