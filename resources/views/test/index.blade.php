<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body id="app">
@if(Session::has('error'))
    <div>
        No topic found!
    </div>
@endif


<h3>Test Topics:</h3>

@{{ $data | json }}

<ul>
    <li v-for="topic in topicList">
        <a href="test/@{{ topic }}">@{{ topic }}</a>
    </li>
</ul>


<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.15/vue.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.2/vue-resource.js"></script>

<script type="text/javascript" src="{{ asset('assets/test/js/testIndex.js') }}"></script>
</body>
</html>