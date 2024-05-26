<!DOCTYPE html>
<html lang="en">
 <head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Laravel</title>
 <link rel="stylesheet" href="{{ asset("assets/bootstrap/css/bootstrap_5.3.3.min.css") }}" />
 </head>
 <body>
 <div id="my_app">
 <home-component></home-component>
 </div>
 @vite('resources/js/vueapp/main.js')
 </body>
</html>