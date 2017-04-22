<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/test/css/animate.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/test/css/vueTransitionAndAnimation.css') }}">

</head>
<body id="app">
@{{ $data | json }}
<br/>
<button @click='show = !show'>Toggle</button>
<br/><br/>
<div style="position: relative">
    <div v-show='show' class='animated animateShow' transition="expand" >Hello World</div>
    <div v-show='!show' class='animated animateShow' transition="expand" >I am back now</div>
</div>

</body>
<script src="http://vuejs.org/js/vue.js"></script>
<script src="{{ asset('assets/test/js/vueTransitionAndAnimation.js') }}"></script>