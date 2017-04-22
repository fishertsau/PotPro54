<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        .completed {
            text-decoration: line-through;
        }
    </style>
</head>
<body id="app">

<p>From Ajax: <span v-show="newsCount">(@{{ newsCount }})<span></span></p>

<newslist :list.sync="list"></newslist>

</body>

<template id="news">
    <ul>
        <li v-for="item in list">@{{ item.title }}
            &nbsp;
            <strong @click="deleteItem(item)">x</strong>
        </li>
    </ul>
</template>

<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.15/vue.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.2/vue-resource.js"></script>
<script src="{{ asset('vueResource.js') }}"></script>