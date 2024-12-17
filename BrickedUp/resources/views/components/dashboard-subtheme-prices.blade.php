<div class="terminal-box"  style="{{$style}}">
    @if(count($favouriteSubthemeValues) === 0)
        <p>No favourite set subthemes, please add them to see the chart</p>
    @else
        <h4>Total Subtheme Values</h4>
        <div style="height: 100%; width: 90%;">
            <canvas id="subthemeValueChart"></canvas>
        </div>
    @endif

</div>

<script>
    const subthemeValues = @json($favouriteSubthemeValues);

    let stLabels = new Array();
    let stValues = new Array();
    let stColors = new Array();

    subthemeValues.forEach(element => {
        stLabels.push(element.subtheme);
        stValues.push(element.value);
        stColors.push(getRandomRgba());
    })

    const subthemeValueData = {
        labels: stLabels,
        datasets: [
            {
                label: "Value",
                data: stValues,
                backgroundColor: stColors
            }
        ]
    };

    const subthemeValuesConfig = {
        type: 'bar',
        data: subthemeValueData,
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
    const subthemeValuesElement = document.getElementById('subthemeValueChart').getContext('2d');
    new Chart(subthemeValuesElement, subthemeValuesConfig);


</script>