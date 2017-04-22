<?php

namespace App\Http\Controllers\Auth;

use Acme\Repositories\UserRepository;
use Auth;
use App\User;
use Carbon\Carbon;
use App\Events\User\SignedIn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/account';
    /**
     * @var UserRepository
     */
    private $userRepo;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepo
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('guest');
        $this->userRepo = $userRepo;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'agreed' => 'required|accepted'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return $this->userRepo->createUser($data);
    }


    /**
     * Handle a registration request for the application.
     * @override
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $user = $this->handleRegister($request->all());

        flash()->overlay('請收取我們剛寄給您的電子郵件,並依照步驟認證電子信箱', '註冊成功');
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


    /**
     * @param $input
     * @return User
     */
    public function handleRegister($input)
    {
        $this->validator($input)->validate();

        event(new Registered($user = $this->create($input)));

        $this->guard()->login($user);

        event(new SignedIn(Auth::user(), Carbon::now(), request()->ip()));

        return $user;
    }
}
