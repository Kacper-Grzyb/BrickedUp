async function fetchSetData() {
    // Access the data passed from the Laravel controller
    const viewData = window.setsData; // Assuming the data is assigned to a global variable in the Blade view

    viewData.forEach(element => {
        console.log(element);
    });

    return viewData.map(set => ({
        "Set Number": set.set_number,
        "Set Name": set.set_name,
        "Theme": set.theme.theme,
        "Subtheme": set.subtheme_id,
        "Market Price": parsePrice(set.retail_price),
        "Release Date": set.release_date
    }));
}

// Add this helper function at the top
function parsePrice(price) {
    return typeof price === 'string' ? parseFloat(price.replace(/[^0-9.-]+/g, '')) : price;
}

// Function to transform CSV data to chart data format
function transformData(set) {
    const releaseDate = new Date(set["Release Date"]);
    const dataPoints = [];
    
    // Add release date point
    dataPoints.push({
        time: releaseDate.toISOString().split('T')[0],
        value: parsePrice(set["Market Price"]),
        label: `${set["Set Name"]} (Release)`
    });
    return dataPoints;
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
            <div><strong>Theme:</strong> ${set["Theme"]}</div>
        `;

        label.appendChild(checkbox);
        label.appendChild(details);
        form.appendChild(label);
    });
}

document.addEventListener('DOMContentLoaded', async () => {
    try {
        const data = await fetchSetData(); // Fetch data from the server
        generateCheckboxes(data); // Generate checkboxes based on dataset

        const chartContainer = document.getElementById('mountainChart');
        const placeholder = document.getElementById('placeholder');
        const loadingSpinner = document.getElementById('loading');

        // Initialize the chart
        const chart = LightweightCharts.createChart(chartContainer, {
            layout: {
                background: {
                    type: 'solid',
                    color: '#121212',
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
            hex = hex.replace(/^#/, '');
            let bigint = parseInt(hex, 16);
            let r = (bigint >> 16) & 255;
            let g = (bigint >> 8) & 255;
            let b = bigint & 255;
            return `${r}, ${g}, ${b}`;
        }

        // Function to get color based on theme ID
        function getColor(themeId) {
            // Map theme IDs to colors
            const themeColors = {
                119: "#26a69a",  // Example color for theme ID 119
                125: "#FFC000",  // Example color for theme ID 125
                128: "#FF5722",  // Example color for theme ID 128
                104: "#8BC34A",  // Example color for theme ID 104
                98: "#3F51B5",   // Example color for theme ID 98
                10: "#9C27B0",   // Example color for theme ID 10
                70: "#FF9800",   // Example color for theme ID 70
                65: "#E91E63",   // Example color for theme ID 65
                71: "#00BCD4",   // Example color for theme ID 71
                9: "#CDDC39",    // Example color for theme ID 9
                130: "#607D8B",  // Example color for theme ID 130
                84: "#795548",   // Example color for theme ID 84
                99: "#FFEB3B",   // Example color for theme ID 99
                120: "#F44336",  // Example color for theme ID 120
                126: "#2196F3",  // Example color for theme ID 126
                77: "#673AB7",   // Example color for theme ID 77
                // Add more theme ID mappings as needed
            };

            return themeColors[themeId] || "#FFFFFF"; // Default to white if theme not found
        }

        // Function to add a new series to the chart
        const addSeries = (setId, setData) => {
            if (seriesMap[setId]) return; // Prevent adding the same series multiple times

            loadingSpinner.style.display = 'block';

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

                loadingSpinner.style.display = 'none';
                placeholder.style.display = 'none';
                updateLegend();
            }, 500);
        };

        // Function to remove a series from the chart
        const removeSeries = (setId) => {
            if (!seriesMap[setId]) return;

            chart.removeSeries(seriesMap[setId]);
            delete seriesMap[setId];

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
            legend.innerHTML = '';

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
                    set["Theme"].toString().includes(query)
                ) {
                    label.style.display = 'flex';
                } else {
                    label.style.display = 'none';
                }
            });
        }

        // Debounce function
        function debounce(func, wait) {
            let timeout;
            return function (...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        // Attach the search handler
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

        window.addEventListener('resize', resizeChart);
        resizeChart();

        // Load initial data for pre-selected sets
        const checkboxes = form.querySelectorAll('input[name="lego_set"]:checked');
        checkboxes.forEach(checkbox => {
            handleCheckboxChange({ target: checkbox });
        });

    }
    catch (error) {
        console.error('Failed to load and process LEGO sets data:', error);
    }
});