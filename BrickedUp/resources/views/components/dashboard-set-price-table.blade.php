<div class="terminal-box"  style="{{$style}}; padding: 0px; align-items:unset">
    @if (count($setPrices) === 0) 
        <h3>Please add favourite sets to be able to see their price records here</h3>
    @else
        <table class="terminal-table">
            <tr>
                <th>Set Name</th>
                <th>Set Number</th>
                <th>Current Market Price</th>
                <th>Price Change</th>
            </tr>
            @for ($i = 0; $i < min(count($setPrices), $displayAmount); $i++)
                    <tr class="terminal-table-row">
                        <td><a href="/set-details/{{$setPrices[$i]->set_number}}" style="text-decoration: none; color: inherit;">{{$setPrices[$i]->set->set_name}}<a></td>
                        <td>{{$setPrices[$i]->set_number}}</td>
                        <td class="for-sale-price">{{$setPrices[$i]->price}}</td>
                        @if(($setPrices[$i]->set->price_change ?? 0) > 0)
                            <td class="positive-change">+{{$setPrices[$i]->set->price_change ?? 0}}%</p>
                        @elseif(($setPrices[$i]->set->price_change ?? 0) == 0)
                            <td class="neutral-change">{{$setPrices[$i]->set->price_change ?? 0}}%</p>
                        @else
                            <td class="negative-change">{{$setPrices[$i]->set->price_change ?? 0}}%</p>
                        @endif
                    </tr>
            @endfor
        
        </table>
    @endif
</div>