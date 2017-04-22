<?php

namespace App\Http\Controllers\Auth;

use App;
use Auth;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\User\SignedIn;
use Acme\Auth\SocialiteGateway;
use Acme\Repositories\UserRepository;
use App\Http\Controllers\Controller;

/**
 * Class SocialiteAuthController
 * @package App\Http\Controllers\Auth
 */
class SocialiteAuthController extends Controller
{
    protected $reDirectToAccountPage = '/account';
    protected $registerController;
    private $socialiteGateway;

    /**
     * SocialiteAuthController constructor.
     * @param RegisterController $registerController
     * @param SocialiteGateway $socialiteGateway
     */
    public function __construct(RegisterController $registerController,
                                SocialiteGateway $socialiteGateway)
    {
        $this->middleware('guest');
        $this->registerController = $registerController;
        $this->socialiteGateway = $socialiteGateway;
    }


    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @param $service
     */
    public function redirectToProvider($service)
    {
        return $this->socialiteGateway->redirectToProvider($service);
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param Request $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws Exception
     */
    public function handleProviderCallback($user)
    {
        try {
            $user = $this->socialiteGateway->handleProviderCallback($user);
        } catch (Exception $e) {
            throw new Exception('User was not found in the service');
        }

        if (!$authUser = $this->userHasRegistered($user)) {
            $this->registerAccount($user);
            return redirect($this->reDirectToAccountPage);
        }

        Auth::login($authUser, true); //remember me
        event(new SignedIn(auth()->user(), Carbon::now(), request()->ip()));

        return redirect($this->reDirectToAccountPage);
    }


    /**
     * @param $user
     * @return mixed
     */
    private function userHasRegistered($user)
    {
        return UserRepository::findByEmail($user->email);
    }

    /**
     * @param $socialiteUser
     * @return mixed
     */
    private function normalizeUserInput($socialiteUser)
    {
        $data['name'] = $socialiteUser->name;
        $data['email'] = $socialiteUser->email;
        $data['password'] = 'secret';
        $data['password_confirmation'] = 'secret';
        $data['agreed'] = true;

        return $data;
    }

    /**
     * @param $user
     */
    private function registerAccount($user)
    {
        $this->registerController->registerSocialite($this->normalizeUserInput($user));
    }
}
