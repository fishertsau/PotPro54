<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        .alert {
            position: relative;
            background: lightgray;
            padding:0.8em;
            border: 1px solid lightcoral;
        }

        .alert--success {
            background: green;
            color: white;
        }

        .alert--error{
            background: red;
            color:white;
        }

        .close-btn{
            position: absolute;
            right: 1em;
            top: 1em;
        }
    </style>
</head>
<body id="app">
<p>Hello vueAlertMessage123</p>
<hr>
<br>

<p>hello a new line below</p>
<alertbox type="success">
    <div>A success alert!123</div>
</alertbox>
<hr>
<alertbox type="error">
    <div>An error alert!</div>
</alertbox>
<hr>
<alertbox type="success">
    <div>Another success alert!</div>
</alertbox>


<template id="alert-temp">
    <div :class="classAlert" v-show="show" >
        <slot></slot>
        <span class="close-btn" @click="show=false"><strong>X</strong></span>
    </div>
</template>

</body>

<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.15/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.2/vue-resource.min.js"></script>

<script src="{{ asset('assets/test/js/vueAlertMessage.js') }}"></script>