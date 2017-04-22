<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>


</head>
<body id="app">

<message @new-message="handleNewMsg"></message>


<template id="practice">
    <input v-model="message" @keyup.enter="storeMessage">
    <button @click='storeMessage'>Enter</button>

    <button @click="clearList">ClearAll</button>
    <br/>
    <button @click="clearMessage">Clear</button>
    <br/>
    Input value:
    <ul>
        <li v-for="item in list">@{{ item }}</li>
    </ul>
</template>

</body>
<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.15/vue.js"></script>
<script src="{{ asset('assets/js/test/vueHandlingEvent.js') }}"></script>