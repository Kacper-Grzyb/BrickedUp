let timeout = window.sessionLifetime; 
let warningTime = 500; 

function resetTimer() {
    timeout = window.sessionLifetime; 
    console.log('Activity detected, timer reset.');
}

function showWarning() {
    alert(`You will be logged out in 1 minute due to inactivity.`);
}

function logout() {
    alert('You have been logged out due to inactivity.');
    window.location.href = window.logoutUrl; 
    console.log('Logging out...');
}

setInterval(function () {
    timeout--;

    if (timeout === warningTime) {
        showWarning(); 
    }

    if (timeout <= 0) {
        logout(); 
    }
}, 1000);

document.addEventListener('mousemove', resetTimer);
document.addEventListener('keypress', resetTimer);

window.addEventListener('beforeunload', function () {
    fetch(window.logoutUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': window.csrfToken,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ _token: window.csrfToken })
    });
});
