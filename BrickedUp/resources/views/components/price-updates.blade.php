<table class="terminal-box" style="{{$style}}">
    <tr>
        <th>Set Name</th>
        <th>Set Number</th>
        <th>Current Market Price</th>
        <th>Price Change</th>
    </tr>
    @foreach ($setPrices as $record) 
        <a href="/set-details/{{$record->set_number}}" style="text-decoration: none; color: inherit;">
            <tr>
                <td class="top-set-name">{{$record->set->set_name}}</td>
                <td class="for-sale-price">{{$record->set_number}}</td>
                <td class="for-sale-price">{{$record->price}}</td>
                @if(($record->set->price_change ?? 0) > 0)
                    <td class="positive-change">+{{$record->set->price_change ?? 0}}%</p>
                @elseif(($record->set->price_change ?? 0) == 0)
                    <td class="neutral-change">{{$record->set->price_change ?? 0}}%</p>
                @else
                    <td class="negative-change">{{$record->set->price_change ?? 0}}%</p>
                @endif
            </tr>
        </a>
    @endforeach 

</table>


<script>
    const setPrices = @json($setPrices);
    console.log(setPrices);
</script>