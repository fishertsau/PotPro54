<div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        電子信箱尚未認證!</h4>

    <ul style="list-style: circle">
        <li><p>您的電子信箱尚未認證,我們已經寄給您一封電子郵件,請收取郵件並依照說明認證您的電子信箱</p></li>
        <li><p>若是您尚未收到電子郵件,請按下面按鈕,我們會重新寄送信箱認證郵件給您</p></li>
        <li><p>*請注意,在您的電子郵件認證前,您可使用的功能將會受到限制.</p></li>
    </ul>

    <br/>

    <form action="email/confirm" method="GET"
          v-ajax
          complete="已送出認證信到您的信箱"
          notComplete="找不到您的資料,請確認您有正確的電子信箱"
            >
        {{csrf_field()}}
        {{method_field('get')}}
        <button class="btn btn-success full-width">
            <i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;重寄認證信
        </button>
    </form>
</div>
