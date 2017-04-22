<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>

</head>
<body id="app">

<input type="number" v-model="testId">
<form action="/test/@{{ testId }}" method="POST" v-ajax complete="The job is done">
    {{method_field('DELETE')}}
    {{csrf_field()}}
    <button type="submit">Delete Test</button>
</form>
</body>
<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.15/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.2/vue-resource.min.js"></script>
<script src="{{ asset('assets/test/js/vueAjaxFormDirective.js') }}"></script>
<script src="{{ asset('assets/test/js/testIndex.js') }}"></script>