<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.15/vue.js"></script>
    <style>
        .completed {
            text-decoration: line-through;
        }
    </style>
</head>
<body id="app">
<div>Geo Location</div>

<hr/>

<p><button onclick="geoFindMe()">Show my location</button></p>
<div id="out"></div>


<script src="{{ asset('assets/test/js/geoLocation.js') }}"></script>

</body>
</html>