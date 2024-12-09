<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Data</title>
</head>
<body>
    <form id="receiveDataForm" action="{{route('receiveData')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="datafile">
        <label for="datafile">CSV File with Set data</label>
        <button type="submit">Upload</button>
    </form>

    <p>To make sure everything gets added to the database correctly, please use the provided csv template</p>
    <form action="{{route('downloadCsvTemplate')}}" method="GET">
        @csrf
        <button type="submit">Download CSV Template</button>
    </form>

    @if (@isset($csvData))
        <p>Uploaded table:</p>
        <table>
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
                <tr>
                    @for ($j = 0; $j <= 9; $j++)
                        <td>{{$csvData[$i][$j]}}</td>
                    @endfor
                </tr>
            @endfor
        </table>

        <form id="uploadDataForm" action="{{route('uploadData')}}" method="POST">
            @csrf
            <input type="hidden" name="data" value="{{json_encode($csvData)}}">
            <button type="submit">Add to Database</button>
        </form>

    @endif

    <form action="{{route('generateSetPriceData')}}" method="POST">
        @csrf
        <button type="submit">Generate Dummy Set Price Data</button>
    </form>
</body>
</html>