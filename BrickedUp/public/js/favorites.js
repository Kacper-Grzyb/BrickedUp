document.addEventListener('DOMContentLoaded', function () {
    const favoriteButtons = document.querySelectorAll('.favorite-btn');

    favoriteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const setNumber = this.closest('.set-item').dataset.setNumber;

            // Check if setNumber is valid
            if (!setNumber) {
                alert('Set number is missing!');
                return;
            }

            const action = this.dataset.action; // "add" or "remove"

            // Make an AJAX request
            fetch(`/favorite-sets/favorites/${action}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ set_number: setNumber })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Toggle button visibility
                        const parent = button.closest('.set-item');
                        parent.querySelector('[data-action="add"]').style.display = action === 'add' ? 'none' : 'block';
                        parent.querySelector('[data-action="remove"]').style.display = action === 'remove' ? 'none' : 'block';
                    } else {
                        alert(data.message || 'An error occurred');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An unexpected error occurred. Please try again later.');
                });
        });
    });
});
