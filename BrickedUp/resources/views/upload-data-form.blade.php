<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Data</title>
</head>
<body>
    <form action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="datafile">
        <label for="datafile">CSV File with Set data</label>
        <button type="submit">Upload</button>
    </form>
</body>
</html>