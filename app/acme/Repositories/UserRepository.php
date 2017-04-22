<?php


namespace Acme\Repositories;

use App\User;
use App\Http\Controllers\Controller;

class UserRepository extends controller
{
//    public static function findUserByAttribute($attribute = null, $value)
//    {
//        try {
//            $user = User::where($attribute, $value)->firstOrFail();
//        } catch (ModelNotFoundException $e) {
//            return $e;
//        }
//        return $user;
//    }

//    public function recordUserLogin()
//    {
//        $user = self::getCurrentUser();
//        session()->put('user_last_login_at', $user->login_at);
//
//        $user->login_at = Carbon::now();
//        $user->login_count += 1;
//        $user->login_ip = get_client_ip();
//
//        $user->save();
//    }
//
//
//    /**
//     * @param $service
//     *  fire event UserHasRegistered  on new user being created
//     * @return static
//     */
//    public static function findOrCreateUser($service)
//    {
//        $authUser = User::whereAvatar($service->avatar)
//            ->orWhere('email', $service->email)
//            ->first();
//
//        if ($authUser) {
//            return $authUser;
//        }
//
//        $name = ($service->nickname == '') ? $service->name : $service->nickname;
//        $newUser = static::createUser($name, $service);
//
//        flash()
//            ->overlay("<p class='text-potmaster'>歡迎您的加入!<br/>- 請將您的個人資料填寫完畢.<br/>- 請收取您的電子郵件,並認證您的電子信箱.</p>");
//
//        return $newUser;
//    }


    public static function createUser($service)
    {
        return User::create([
            'name' => $service['name'],
            'email' => $service['email'],
            'password' => bcrypt($service['password'])
        ]);
    }


    public function stampSignIn($user, $time, $ip)
    {
        $user->increment('signIn_count');
//
//        $user->last_signIn_at = $user->signIn_at;
//        $user->signIn_at = $time;
//
//        $user->last_signIn_ip = $user->signIn_ip;
//        $user->signIn_ip = $ip;
//
        $user->save();
    }

    public static function findByEmail($email)
    {
        return User::whereEmail($email)->first();
    }

}