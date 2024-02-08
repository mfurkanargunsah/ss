<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Document</title>
</head>
<body>
    
    <form action="/imageupload" method="POST" enctype="multipart/form-data">
        @csrf
    
        <input type="file" name="image" id="image">
        <button type="submit">Gönder</button> 
    </form>
    

</body>
</html>