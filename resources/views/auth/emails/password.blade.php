<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h3>�K�X���s�]�w</h3>

<div>
    <p>�z�n,�z���e�X�F���s�]�w�K�X���n�D.</p>
    <p>���I��H�U�s��,�i��K�X���s�]�w:</p>
    <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>

    <br/>
    <br/>
    <ul>
        <li>�H�W�s���b{{ Config::get('auth.reminder.expire', 60) }} ����������,�Y�O�W�L���s�]�w�ɶ�,�Э��s���X�K�X�]�w�\��.</li>
        <li>�Y�O�z�S�����X���s�]�w�K�X���n�D,�Ф��γB�z�o�ʶl��.</li>
    </ul>

</div>
</body>
</html>