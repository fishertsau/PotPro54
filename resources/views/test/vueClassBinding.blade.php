<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        .Alert {
            position: relative;
            background: #ddd;
            border: 1px solid #aaa;
            padding: 1em;
            width: 30%;
        }

        .Alert-Error {
            background: red;
            border: 1px solid darkred
        }

        .Alert-Success {
            background: green;
            border: 1px solid darkgreen
        }

        .Alert--close {
            position: absolute;
            top: 1em;
            right: 1em;
            cursor: pointer;
        }

    </style>
</head>

<body id="app">

<alert type="success">
    <span>Success! You account has been updated!</span>
</alert>

<br/>

<alert type="error">
    <span>Error! You account has not been updated!</span>
</alert>

<br/>

<alert type="general">
    <span>Info! You account has not been updated!</span>
</alert>

<template id="alert-template">
    <div :class="classAlert" v-show="show">
        <slot></slot>
        <strong class="Alert--close" @click="show=false">x</strong>
    </div>
</template>

</body>

<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.15/vue.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.2/vue-resource.js"></script>
<script src="{{ asset('assets/test/js/vueClassBinding.js') }}"></script>