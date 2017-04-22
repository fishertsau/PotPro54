<!DOCTYPE html>
<html>
<head>
    <title>鍋教授</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

</head>
<body>
<h4>親愛的 {{$order->buyer->name}}:</h4>

<p>您好!</p>

<p>您訂購的東西已經寄出.</p>
@include('admin.order.edit._orderShipment')
<br/>

<p>你可以在以下網站查詢寄送進度:</p>
<ul>
    <li>新竹貨運: <a href="https://www.hct.com.tw/searchgoods_index.aspx">https://www.hct.com.tw/searchgoods_index.aspx</a>
    </li>
</ul>
<hr/>
@include('admin.order.edit._orderSummary')
@include('admin.order.edit._orderItemList')

</body>
</html>
