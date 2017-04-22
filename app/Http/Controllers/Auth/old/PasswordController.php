<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = '/';
    protected $subject = '鍋教授會員,密碼重新設定!';

    protected $linkRequestView = 'auth.passwords.email';
    protected $resetView = 'auth.passwords.reset';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['passwordreset', 'showResetForm']]);
    }


    public function passwordreset(Request $request)
    {
        if ($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'password' => 'required|min:6',
                'confirmPassword' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return redirect('/admin')
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = Auth::user();
            $password = $request->get('password');
            $user->password = Hash::make($password);
            $user->save();
        }
    }


    /**
     * @param Request $request
     * @override
     */
    public function sendResetLinkEmail(Request $request)
    {
        dump('here0');
        $this->validateSendResetLinkEmail($request);

        dump('hereA');
        $broker = $this->getBroker();

        dump('here1');

        $response = Password::broker($broker)->sendResetLink(
            $this->getSendResetLinkEmailCredentials($request),
            $this->resetEmailBuilder()
        );

        dump('here2');

        switch ($response) {
            case Password::RESET_LINK_SENT:
                dump('here3');
                return $this->getSendResetLinkEmailSuccessResponse($response);
            case Password::INVALID_USER:
            default:
                return $this->getSendResetLinkEmailFailureResponse($response);
        }
    }

//    /**
//     * @override
//     */
//    public function showLinkRequestForm(){
//        return 'show reset';
//    }


    /**
     * @param Request $request
     * @param null $token
     * @override
     */
//    public function showResetForm(Request $request, $token = null){
//        return 'show form';
//    }
}
