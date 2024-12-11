<div class="terminal-box" style="{{$style}}">
    <a href="full-graph" style="text-decoration: none; color: inherit;">
        <h4>LEGO Theme Marketshare</h4>
    </a>
    <div>
        <canvas id="marketShareChart"></canvas>
    </div>
</div>
    
<script>
    const sets = @json($sets);

    let themeShares = new Map();

    sets.forEach(set => {
        let themeName = set['theme']['theme'];
        const existingThemeShare = themeShares.get(themeName);
        themeShares.set(themeName, (existingThemeShare ?? 0) + parseFloat(set['retail_price']));
    });
    
    const marketShareData = {
        labels: Array.from(themeShares.keys()),
        datasets: [
            {
                label: "Value",
                data: Array.from(themeShares.values()),
                hoverOffset: 4
            }
        ]
    };

    const config = {
        type: 'pie',
        data: marketShareData,
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
    const ctx = document.getElementById('marketShareChart').getContext('2d');
    new Chart(ctx, config);
</script>
