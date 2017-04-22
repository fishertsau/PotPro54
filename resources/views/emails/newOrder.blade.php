<!DOCTYPE html>
<html>
<head>
    <title>鍋教授</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

</head>
<body>
<h4>親愛的 {{$order->buyer->name}}:</h4>

<p>您好!</p>

<p>我們已經收到您的訂單.我們會盡快處理您的訂單.</p>
<hr/>
@include('admin.order.edit._orderSummary')
@include('admin.order.edit._orderItemList')
</body>
</html>
