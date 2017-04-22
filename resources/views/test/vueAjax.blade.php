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
<p>From Vue:</p>
<newslist></newslist>


</body>

<template id="news">
    <ul>
        <li v-for="news in list">@{{ news.title }}
            <strong @click='deleteNews(news)'>x</strong>
        </li>
    </ul>
</template>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/test/vueResource.js') }}"></script>