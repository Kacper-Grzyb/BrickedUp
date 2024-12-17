<div class="terminal-box"  style="{{$style}}">
    @if(count($favouriteSetPriceRecords) === 0)
        <p>No favourite sets added, please add them to see the chart</p>
    @else
        <h4>Set Price Trends</h4>
        <div style="height: 100%; width: 90%;">
            <canvas id="setPriceChart"></canvas>
        </div>
    @endif

</div>

<script>
    const prices = @json($favouriteSetPriceRecords);

    let minDate = 8.64e15;
    let maxDate = 0;
    const setsMap = new Map();

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
        const day = String(date.getDate()).padStart(2, '0');

        return `${year}-${month}-${day}`;
    }

    prices.forEach(element => {
        setsMap.set(element.set_number, new Array());
        let currDate = (new Date(element.record_date)).getTime()
        if(currDate < minDate) minDate = currDate;
        if(currDate > maxDate) maxDate = currDate
    });

    const datesMap = new Map();
    for(let i = minDate; i<maxDate; i+=86400000) {
        datesMap.set(formatDate(new Date(i)), new Map());
    }

    prices.forEach(element => {
        if(datesMap.get(element.record_date) !== undefined) 
        {
            datesMap.get(element.record_date).set(element.set_number, element.price);
        }
    });

    datesMap.forEach(element => {
        Array.from(setsMap.keys()).forEach(setNum => {
            let price = element.get(setNum);
            if(price === undefined) setsMap.get(setNum).push(0);
            else setsMap.get(setNum).push(price);
        })
    });

    const setPricesData = {
        labels: Array.from(datesMap.keys()),
        datasets: []
    };

    Array.from(setsMap.keys()).forEach(setNum => {
        setPricesData.datasets.push(
            {
                label: setNum,
                data: setsMap.get(setNum)
            }
        );
    });

    const setPricesConfig = {
        type: 'line',
        data: setPricesData,
        options: {
            responsive: true
        }
    };

    // Render the chart
    const setPricesElement = document.getElementById('setPriceChart').getContext('2d');
    new Chart(setPricesElement, setPricesConfig);

</script>