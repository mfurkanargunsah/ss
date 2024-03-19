
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Schloss Schaumburg GmbH</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
  @include('header')

  
    @yield('items')
    @yield('about_us')
    @yield('privacy')
    @yield('kvkk')
    @yield('contact')
    @yield('subs')

   
    




     @include('footer')
    
    
  



</body>
</html>

