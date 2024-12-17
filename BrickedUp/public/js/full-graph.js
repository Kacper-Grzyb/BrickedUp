function getUniqueColor(str) {
    let hash = 0;
    for (let i = 0; i < str.length; i++) {
        hash = str.charCodeAt(i) + ((hash << 5) - hash);
    }
    // Convert the hash to an RGB color
    const r = (hash >> 16) & 0xFF;
    const g = (hash >> 8) & 0xFF;
    const b = hash & 0xFF;
    // Convert RGB to HEX
    return `#${((1 << 24) + (r << 16) + (g << 8) + b)
        .toString(16)
        .slice(1)
        .toUpperCase()}`;
}

function hexToRgb(hex) {
    hex = hex.replace(/^#/, '');
    let bigint = parseInt(hex, 16);
    let r = (bigint >> 16) & 255;
    let g = (bigint >> 8) & 255;
    let b = bigint & 255;
    return `${r}, ${g}, ${b}`;
}

async function fetchSetData() {
    const viewData = window.setsData; 

    viewData.forEach(element => {
        console.log(element);
    });

    return viewData;
}

function parsePrice(price) {
    return typeof price === 'string' ? parseFloat(price.replace(/[^0-9.-]+/g, '')) : price;
}


function transformData(set) {
    return set.prices.map(priceRecord => ({
        time: new Date(priceRecord.record_date).getTime() / 1000,
        value: parsePrice(priceRecord.price),
    }));
}


function generateCheckboxes(data) {
    const form = document.getElementById('lego-sets-form');
    data.forEach(set => {
        const label = document.createElement('label');
        label.classList.add('option-container');

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'lego_set';
        checkbox.value = set.set_number;

        const details = document.createElement('div');
        details.classList.add('option-details');
        details.innerHTML = `
            <div><strong>Set Number:</strong> ${set.set_number}</div>
            <div><strong>Name:</strong> ${set.set_name}</div>
            <div><strong>Theme:</strong> ${set.theme.theme}</div>
        `;

        label.appendChild(checkbox);
        label.appendChild(details);
        form.appendChild(label);
    });
}

document.addEventListener('DOMContentLoaded', async () => {
    try {
        const data = await fetchSetData(); 
        const setsData = data; 
        generateCheckboxes(setsData); 

        const chartContainer = document.getElementById('mountainChart');
        const placeholder = document.getElementById('placeholder');
        const loadingSpinner = document.getElementById('loading');


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


        const seriesMap = {};

        const addSeries = (setId, setData) => {
            if (seriesMap[setId]) return; // Prevent adding the same series multiple times

            // Check if there are price records
            if (!setData.prices || setData.prices.length === 0) {
                console.warn(`No price data available for set: ${setId}`);
                return;
            }

            loadingSpinner.style.display = 'block';

            setTimeout(() => {
                // Generate a unique color for the set based on its set number
                const uniqueColor = getUniqueColor(setId);

                const newSeries = chart.addAreaSeries({
                    topColor: `rgba(${hexToRgb(uniqueColor)}, 0.5)`,
                    bottomColor: `rgba(${hexToRgb(uniqueColor)}, 0.0)`,
                    lineColor: uniqueColor,
                    lineWidth: 2,
                });

                // Transform historical price data
                const historicalData = transformData(setData);
                newSeries.setData(historicalData);
                seriesMap[setId] = newSeries;

                loadingSpinner.style.display = 'none';
                placeholder.style.display = 'none';
                updateLegend();
            }, 500);
        };

        const removeSeries = (setId) => {
            if (!seriesMap[setId]) return;

            chart.removeSeries(seriesMap[setId]);
            delete seriesMap[setId];

            if (Object.keys(seriesMap).length === 0) {
                placeholder.style.display = 'block';
            }

            updateLegend();
        };

        const handleCheckboxChange = (event) => {
            const checkbox = event.target;
            const setId = checkbox.value;

            if (checkbox.checked) {
                const setData = setsData.find(s => s.set_number === setId);
                if (setData) {
                    addSeries(setId, setData);
                }
            } else {
                removeSeries(setId);
            }
        };

        const form = document.getElementById('lego-sets-form');
        form.addEventListener('change', (event) => {
            if (event.target.name === 'lego_set') {
                handleCheckboxChange(event);
            }
        });

        const updateLegend = () => {
            const legend = document.getElementById('legend');
            legend.innerHTML = '';

            Object.keys(seriesMap).forEach(setId => {
                const set = setsData.find(s => s.set_number === setId);
                if (!set) return;

                // Generate the same unique color used in the series
                const uniqueColor = getUniqueColor(setId);

                const legendItem = document.createElement('span');
                legendItem.style.color = uniqueColor;
                legendItem.style.marginLeft = '15px';
                legendItem.innerHTML = `&#9679; ${set.set_name}`;
                legend.appendChild(legendItem);
            });
        };

        function handleSearch(query) {
            const form = document.getElementById('lego-sets-form');
            const checkboxes = form.querySelectorAll('input[name="lego_set"]');
            setsData.forEach((set, index) => {
                const label = checkboxes[index].closest('.option-container');
                if (
                    set.set_number.includes(query) ||
                    set.set_name.toLowerCase().includes(query.toLowerCase()) ||
                    set.theme.theme.toLowerCase().includes(query.toLowerCase())
                ) {
                    label.style.display = 'flex';
                } else {
                    label.style.display = 'none';
                }
            });
        }

        function debounce(func, wait) {
            let timeout;
            return function (...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        const searchInput = document.getElementById('search-input-chart');
        searchInput.addEventListener('input', debounce((event) => {
            const query = event.target.value.trim();
            handleSearch(query);
        }, 300));

        const resizeChart = () => {
            chart.applyOptions({
                width: chartContainer.clientWidth,
                height: chartContainer.clientHeight,
            });
        };

        window.addEventListener('resize', resizeChart);
        resizeChart();

        const checkboxes = form.querySelectorAll('input[name="lego_set"]:checked');
        checkboxes.forEach(checkbox => {
            handleCheckboxChange({ target: checkbox });
        });

    }
    catch (error) {
        console.error('Failed to load and process LEGO sets data:', error);
    }
});
