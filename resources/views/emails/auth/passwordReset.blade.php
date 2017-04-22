<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h3>密碼重新設定</h3>

<div>
    <p>您好,您剛剛送出了重新設定密碼的要求.</p>
    <p>請點選以下連結,進行密碼重新設定:</p>
    <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>

    <br/>
    <br/>
    <ul>
        <li>以上連結在{{ Config::get('auth.reminder.expire', 60) }} 分鐘內有效,若是超過重新設定時間,請重新提出密碼設定功能.</li>
        <li>若是您沒有提出重新設定密碼的要求,請不用處理這封郵件.</li>
    </ul>

</div>
</body>
</html>