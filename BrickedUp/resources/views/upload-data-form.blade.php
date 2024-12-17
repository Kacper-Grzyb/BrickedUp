<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>BrickedUp - Home</title>
</head>

<body>
    <x-navbar :currentPage='"upload-data"'/>

    <h1>Control Panel</h1>

    <div class="control-panel-header">
        <div class="control-box">
            <form id="receiveDataForm" action="{{route('receiveData')}}" method="POST" enctype="multipart/form-data" class="csv-upload-box">
                @csrf
                <label for="datafile">CSV File with Set data</label>
                <input type="file" name="datafile">
                <button type="submit" class="panel-button">Upload</button>
            </form>
            
            <form action="{{route('downloadCsvTemplate')}}" method="GET" class="csv-template-box">
                @csrf
                <button type="submit" class="panel-button">Download CSV Template</button>
                <h6>To make sure everything gets added to the database correctly, please use the provided csv template</h6>
            </form>
        </div>

        <div class="additional-container">
            <form id="uploadDataForm" action="{{route('uploadData')}}" method="POST" class="save-box">
                @csrf
                @if (@isset($csvData))
                    <input type="hidden" name="data" value="{{json_encode($csvData)}}">
                    <button type="submit" class="panel-button">Add to Database</button>
                @else
                    <button type="submit" class="panel-button-disabled" disabled>Add to Database</button>
                @endif
            </form>
    
            <form action="{{route('calculateChanges')}}" method="POST" class="generate-box">
                @csrf
                <button type="submit" class="panel-button">Calculate Set Price Changes</button>
            </form>
        </div>
    </div>

    @if (@isset($csvData))
        <div class="panel-table-container">
            <table class="panel-table">
                <tr>
                    <th>Set Number</th>
                    <th>Set Name</th>
                    <th>Theme</th>
                    <th>Subtheme</th>
                    <th>Release Date</th>
                    <th>Retired Date</th>
                    <th>Availability</th>
                    <th>Piece Count</th>
                    <th>Minifigures</th>
                    <th>Retail Price</th>
                </tr>
    
                @for ($i = 0; $i < count($csvData); $i++)
                    @if($csvData[$i][0] !== "")
                    <tr>
                        @for ($j = 0; $j <= 9; $j++)
                            <td>{{$csvData[$i][$j]}}</td>
                        @endfor
                    </tr>
                    @endif
                @endfor
            </table>  
        </div>
    @endif
</body>
</html>