<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Vue Router Message Example From Scratch - ItSolutionStuff.com</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" 
rel="stylesheet" />
    </head>
    <body>
        <h1>Laravel Vue Router Example From Scratch - ItSolutionStuff.com</h1>
        <div id="app">
            <router-view></router-view>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="{{asset('js/app.js')}}" ></script>
    </body>
</html>