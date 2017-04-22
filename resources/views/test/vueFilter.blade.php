<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>


</head>
<body id="app">
<ul>
    <li v-for="person in people | role 'admin'">@{{ person.name }}:@{{ person.role }}</li>
</ul>

</body>
<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.15/vue.js"></script>
<script src="{{ asset('assets/test/js/vueFilter.js') }}"></script>