<!DOCTYPE html>
<html>
<head>
    <title>鍋教授</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

</head>
<body>
<h4>親愛的 {{$order->buyer->name}}:</h4>

<p>您好!</p>

<p>很抱歉通知您,您的訂購單已被退回.</p>

<p>如有任何問題,請與我們聯絡,我們會進一步為您服務.</p>

<br/>
<h5>退件原因:</h5>

<p>{{$auditRecord->comments}}</p>

<hr/>
@include('admin.order.edit._orderSummary')
@include('admin.order.edit._orderItemList')

</body>
</html>
