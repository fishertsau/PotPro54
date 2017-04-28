<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Validator;
use Socialite;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Acme\Repositories\UserRepository;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect user after login / registration.
     *
     * @var string
     */
    //Which page to turn to after successful registration
    protected $redirectPath = '/admin';

    //Which page to turn to after failed registration
    protected $loginPath = '/login';

    //which page to turn to after logout
    protected $redirectAfterLogout = '/';


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest',
            ['except' => ['getLogout']]);
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
            'password' => 'required|confirmed|min:6',
            'agreed'    =>'required'
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }



    /*Socialite Login*/
    /**
     * Redirect the user to the Social service authentication page.
     *
     * @param AuthenticateUser $authenticateUser
     * @param Request $request
     * @return Response
     */
    public function redirectSocialite($service)
    {
        $service = (string)$service;
        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleSocialiteCallback($service)
    {
        $redirectPath = 'auth/socialite/' . $service;

        try {
            $user = Socialite::driver($service)->user();
        } catch (Exception $e) {
            return redirect($redirectPath);
        }

        $authUser = UserRepository::findOrCreateUser($user);

        Auth::login($authUser, false); //remember me
        event('user.login');

        return redirect($this->redirectPath());
    }


    /** This functions overrides the trait
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());


        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }


        Auth::guard($this->getGuard())->login($this->create($request->all()));

        //The following two lines are added on top of the ancestor methods.
        event('user.login');
        flash()
            ->overlay("<p class='text-potmaster'>歡迎您的加入!<br/>- 請將您的個人資料填寫完畢.<br/>- 請收取您的電子郵件,並認證您的電子信箱.</p>");

        return redirect($this->redirectPath());
    }




    /**  This method overrides the ancestors methods
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

        //The following one line are added on top of the ancestor methods.
        event('user.login');

        return redirect()->intended($this->redirectPath());
    }
}
