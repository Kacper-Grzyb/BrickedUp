
    <div class="terminal-box" style="{{$style}}">
        <h2>Lego Set &emsp; Price &emsp; Change &nbsp; Set Number</h2>

        @foreach ($setPrices as $record) 
            <a href="/set-details/{{$record->set_number}}" style="text-decoration: none; color: inherit;">
                <div class="top-set">
                    <p class="top-set-name">Migrations Issue</p>
                    <p class="for-sale-price">{{$record->price}}</p>
                    <p class="positive-change">+0.42</p>
                    <p class="for-sale-price">{{$record->set_number}}</p>
                </div>
            </a>
        @endforeach 
    
    </div>


<script>
    const setPrices = @json($setPrices);
    console.log(setPrices);
</script>