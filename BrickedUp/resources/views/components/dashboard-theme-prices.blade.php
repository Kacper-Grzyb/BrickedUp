<div class="terminal-box"  style="{{$style}}">
    @if(count($favouriteThemeValues) === 0)
        <p>No favourite sets themes, please add them to see the chart</p>
    @else
        <h4>Total Theme Values</h4>
        <div id>
            <canvas id="themeValueChart"></canvas>
        </div>
    @endif

</div>

<script>
    const themeValues = @json($favouriteThemeValues);

    let labels = new Array();
    let values = new Array();
    let colors = new Array();

    themeValues.forEach(element => {
        labels.push(element.theme);
        values.push(element.value);
        colors.push(getRandomRgba());
    })

    const themeValueData = {
        labels: labels,
        datasets: [
            {
                label: "Value",
                data: values,
                backgroundColor: colors
            }
        ]
    };

    const themeValuesConfig = {
        type: 'bar',
        data: themeValueData,
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: false
                },
                legend: {
                    display: false
                }
            }
        }
    };

    // Render the chart
    const themeValuesElement = document.getElementById('themeValueChart').getContext('2d');
    new Chart(themeValuesElement, themeValuesConfig);

    function getRandomRgba() {
    const r = Math.floor(Math.random() * 256);  
    const g = Math.floor(Math.random() * 256);  
    const b = Math.floor(Math.random() * 256);  

    return `rgba(${r}, ${g}, ${b}, 1)`;
}

</script>