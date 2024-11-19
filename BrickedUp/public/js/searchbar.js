const searchInput = document.getElementById('search-input');
const searchResults = document.getElementById('search-results');

let debounceTimer;

searchInput.addEventListener('input', function () {
    const setName = this.value;

    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        if (setName.length > 0) {
            console.log("Searching: " + setName);
            fetch(`/search-legosets?query=${setName}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    searchResults.innerHTML = '';
                    searchResults.style.display = 'block';
                    if (data.length > 0) {
                        data.forEach(set => {
                            const item = document.createElement('div');
                            item.classList.add('search-result');
                            item.textContent = set.set_name;
                            item.addEventListener('click', () => {
                                searchResults.innerHTML = '';
                                this.value = '';
                                searchResults.style.display = 'none';

                                console.log("Redirect to: " + set.set_name);
                                window.location.href = '/set-details';
                            });
                            searchResults.appendChild(item);
                        });
                    } else {
                        searchResults.innerHTML = '<div class="search-result">No results found</div>';
                    }
                });
        } else {
            searchResults.innerHTML = '';
            searchResults.style.display = 'none';
        }
    }, 300);
});
