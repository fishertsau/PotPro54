<p>請點選以下連結認證您的電子信箱,以使用我們提供給您完整功能!</p>
<a href="{{route('confirmEmail',['token'=>$user->verified_token] )}}">{{route('confirmEmail',['token'=>$user->verified_token])}}&nbsp;</a>
<br/>
<br/>

<p>*請注意,在您的電子郵件認證前,您可使用的功能將會受到限制.</p>
