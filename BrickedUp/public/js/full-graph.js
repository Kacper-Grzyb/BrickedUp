// chart-page.js

// Function to load and parse the CSV file using Papa Parse
function loadCSVFile(url) {
    return new Promise((resolve, reject) => {
        Papa.parse(url, {
            download: true,
            header: true,
            skipEmptyLines: true,
            complete: function(results) {
                resolve(results.data);
            },
            error: function(err) {
                reject(err);
            }
        });
    });
}

// Function to transform CSV data to chart data format
function transformData(set) {
    // Parse the release date to a JavaScript Date object
    const releaseDate = new Date(set["Release Date"]);
    // If retiredDate is available and not "-", parse it
    const retiredDateRaw = set["Retired Date"];
    const retiredDate = retiredDateRaw && retiredDateRaw !== "-" && retiredDateRaw.toLowerCase() !== "still available"
        ? new Date(retiredDateRaw)
        : null;

    const dataPoints = [
        {
            time: releaseDate.toISOString().split('T')[0], // Format as YYYY-MM-DD
            value: parsePrice(set["Market Price"]),
            label: `${set["Set Name"]} (Release)`,
        },
    ];

    if (retiredDate) {
        dataPoints.push({
            time: retiredDate.toISOString().split('T')[0],
            value: parsePrice(set["Market Price"]),
            label: `${set["Set Name"]} (Retired)`,
        });
    }

    return dataPoints;
}

// Function to parse price strings to numbers
function parsePrice(priceStr) {
    if (typeof priceStr === 'number') return priceStr;
    // Replace comma with dot and remove currency symbols
    return parseFloat(priceStr.replace(',', '.').replace('€', '').replace('€', ''));
}

// Function to dynamically generate checkboxes
function generateCheckboxes(data) {
    const form = document.getElementById('lego-sets-form');
    data.forEach(set => {
        const label = document.createElement('label');
        label.classList.add('option-container');

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'lego_set';
        checkbox.value = set["Set Number"];

        const details = document.createElement('div');
        details.classList.add('option-details');
        details.innerHTML = `
            <div><strong>Set Number:</strong> ${set["Set Number"]}</div>
            <div><strong>Name:</strong> ${set["Set Name"]}</div>
            <div><strong>Theme:</strong> <a href="#">${set["Theme"]}${set["Subtheme"] && set["Subtheme"] !== "-" ? ` - ${set["Subtheme"]}` : ''}</a></div>
        `;

        label.appendChild(checkbox);
        label.appendChild(details);
        form.appendChild(label);
    });
}

document.addEventListener('DOMContentLoaded', async () => {
    try {
        // Load and parse the CSV file
        const data = await loadCSVFile('data/legoSets.csv'); // Ensure the path is correct
        generateCheckboxes(data); // Generate checkboxes based on dataset

        const chartContainer = document.getElementById('mountainChart');
        const placeholder = document.getElementById('placeholder');
        const loadingSpinner = document.getElementById('loading');

        // Initialize the chart
        const chart = LightweightCharts.createChart(chartContainer, {
            layout: {
                background: {
                    type: 'solid',
                    color: '#000000',
                },
                textColor: '#FFFFFF',
            },
            grid: {
                vertLines: {
                    color: '#444444',
                },
                horzLines: {
                    color: '#444444',
                },
            },
            timeScale: {
                timeVisible: true,
                borderColor: '#444444',
            },
            rightPriceScale: {
                borderColor: '#444444',
            },
        });

        // Store series references
        const seriesMap = {};

        // Function to convert HEX color to RGB
        function hexToRgb(hex) {
            // Remove '#' if present
            hex = hex.replace(/^#/, '');

            // Parse r, g, b values
            let bigint = parseInt(hex, 16);
            let r = (bigint >> 16) & 255;
            let g = (bigint >> 8) & 255;
            let b = bigint & 255;

            return `${r}, ${g}, ${b}`;
        }

        // Function to get color based on theme
        function getColor(theme) {
            const themeColors = {
                "Star Wars": "#26a69a",
                "IDEAS": "#FFC000",
                "Super Mario": "#FF5722",
                "Clone Wars": "#3F51B5",
                "Power Miners": "#9C27B0",
                "Ninjago": "#4CAF50",
                "Bionicle": "#E91E63",
                "Atlantis": "#00BCD4",
                "Brickheadz": "#FF9800",
                "Marvel": "#F44336",
                "DC": "#2196F3",
                "Indiana Jones": "#795548",
                "Harry Potter": "#673AB7",
                "Technic": "#607D8B",
                "Icons": "#8BC34A",
                "Creator Expert": "#CDDC39",
                "Art": "#FFEB3B",
                "Jurassic World": "#009688",
                "Architecture": "#FFC107",
                "Stranger Things": "#FF5722",
                "Speed Champions": "#795548",
                "Monkie Kid": "#3F51B5",
                "Seasonal": "#E91E63",
                // Add more themes and their colors as needed
            };

            return themeColors[theme] || "#FFFFFF"; // Default to white if theme not found
        }

        // Function to add a new series to the chart
        const addSeries = (setId, setData) => {
            if (seriesMap[setId]) return; // Prevent adding the same series multiple times

            loadingSpinner.style.display = 'block'; // Show loading spinner

            // Simulate data fetching delay (since data is local, you can remove this in production)
            setTimeout(() => {
                const newSeries = chart.addAreaSeries({
                    topColor: `rgba(${hexToRgb(getColor(setData["Theme"]))}, 0.5)`,
                    bottomColor: `rgba(${hexToRgb(getColor(setData["Theme"]))}, 0.0)`,
                    lineColor: getColor(setData["Theme"]),
                    lineWidth: 2,
                });

                const dataPoints = transformData(setData);
                newSeries.setData(dataPoints);
                seriesMap[setId] = newSeries;

                loadingSpinner.style.display = 'none'; // Hide loading spinner
                placeholder.style.display = 'none'; // Hide placeholder
                updateLegend();
            }, 500); // 0.5-second delay
        };

        // Function to remove a series from the chart
        const removeSeries = (setId) => {
            if (!seriesMap[setId]) return;

            chart.removeSeries(seriesMap[setId]);
            delete seriesMap[setId];

            // Show placeholder if no series are present
            if (Object.keys(seriesMap).length === 0) {
                placeholder.style.display = 'block';
            }

            updateLegend();
        };

        // Function to handle checkbox changes
        const handleCheckboxChange = (event) => {
            const checkbox = event.target;
            const setId = checkbox.value;

            if (checkbox.checked) {
                const setData = data.find(s => s["Set Number"] === setId);
                if (setData) {
                    addSeries(setId, setData);
                }
            } else {
                removeSeries(setId);
            }
        };

        // Attach event listeners to all checkboxes
        const form = document.getElementById('lego-sets-form');
        form.addEventListener('change', (event) => {
            if (event.target.name === 'lego_set') {
                handleCheckboxChange(event);
            }
        });

        // Function to update the legend
        const updateLegend = () => {
            const legend = document.getElementById('legend');
            legend.innerHTML = ''; // Clear existing legend

            Object.keys(seriesMap).forEach(setId => {
                const set = data.find(s => s["Set Number"] === setId);
                if (!set) return;

                const legendItem = document.createElement('span');
                legendItem.style.color = getColor(set["Theme"]);
                legendItem.style.marginLeft = '15px';
                legendItem.innerHTML = `&#9679; ${set["Set Name"]}`;
                legend.appendChild(legendItem);
            });
        };

        // Function to handle search functionality
        function handleSearch(query) {
            const form = document.getElementById('lego-sets-form');
            const checkboxes = form.querySelectorAll('input[name="lego_set"]');
            data.forEach((set, index) => {
                const label = checkboxes[index].closest('.option-container');
                if (
                    set["Set Number"].includes(query) ||
                    set["Set Name"].toLowerCase().includes(query.toLowerCase()) ||
                    set["Theme"].toLowerCase().includes(query.toLowerCase()) ||
                    (set["Subtheme"] && set["Subtheme"].toLowerCase().includes(query.toLowerCase()))
                ) {
                    label.style.display = 'flex';
                } else {
                    label.style.display = 'none';
                }
            });
        }

        // Debounce function to limit the rate of function execution
        function debounce(func, wait) {
            let timeout;
            return function (...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        // Attach the search handler to the input with debouncing
        const searchInput = document.getElementById('search-input');
        searchInput.addEventListener('input', debounce((event) => {
            const query = event.target.value.trim();
            handleSearch(query);
        }, 300));

        // Function to resize the chart
        const resizeChart = () => {
            chart.applyOptions({
                width: chartContainer.clientWidth,
                height: chartContainer.clientHeight,
            });
        };

        // Add event listener for window resize
        window.addEventListener('resize', resizeChart);

        // Trigger initial resize to ensure proper sizing
        resizeChart();

        // Optional: Load initial data if any sets are pre-selected
        const checkboxes = form.querySelectorAll('input[name="lego_set"]:checked');
        checkboxes.forEach(checkbox => {
            handleCheckboxChange({ target: checkbox });
        });

    }
    catch (error) {
        console.error('Failed to load and process LEGO sets data:', error);
    }
});
