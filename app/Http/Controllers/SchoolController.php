<?php namespace App\Http\Controllers;

use App\Http\Mail\UserMailer;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSchoolRequest;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use \Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;
use Validator;

class SchoolController extends Controller {
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The registrar implementation.
     *
     * @var Registrar
     */
    protected $registrar;

    /**
     * The redirectPath variable for the school admin page
     *
     * TEMPORARY.
     */

    protected $redirectTo = '/';

    public $schools ;
    /**
     * @var UserMailer
     */
    private $mailer;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard $auth
     * @param  \Illuminate\Contracts\Auth\Registrar $registrar
     * @param UserMailer $mailer
     */
    public function __construct(Guard $auth, Registrar $registrar, UserMailer $mailer)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

        //$this->middleware('guest', ['except' => 'getLogout, getHome']);
        $this->mailer = $mailer;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoginAndRegister()
    {
        return view('school.auth.loginAndRegistration');
    }

    public function getRegister()
    {
        return view('inspina/auth/register');
    }

    public function newUser($data, $activationCode)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'telNumber' => $data['telNumber'],
            'active' => 0,
            'code' => $activationCode,
        ]);
    }

    public function getTrial($user)
    {
        \Auth::login($user);

            $active = \Auth::user()->isActive();
            $currentUser = \Auth::user();

            if(!$active){
                $this->auth->logout();
                return redirect('/notActivated/' . $currentUser->id);
            }
            if($currentUser->isTrial())
            {
                $this->flash('Your account is not verified, Please verify within '. (7 - $currentUser->trialDays()) .' days');
                $this->mailer->sendConfirmationMailTo($currentUser, $currentUser->code);
            }
            return redirect()->intended('/');
    }

    public function getNotActivated($user)
    {
        $this->mailer->sendConfirmationMailTo($user, $user->code);
        return view('inspina.account.notActivated', compact('user'));
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $activationCode = str_random(90);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'firstName' => 'required',
            'lastName' => 'required',
            'telNumber' => 'required',
        ]);

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $user  = $this->newUser($request->all(), $activationCode);



        $this->mailer->sendConfirmationMailTo($user, $activationCode);

        return redirect('/notActivated/'.$user->id);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('inspina/auth/login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->where('password',  bcrypt($request->password))->first();

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            $active = \Auth::user()->isActive();
            $currentUser = \Auth::user();

            if(!$active){
                $this->auth->logout();
                return redirect('/notActivated/' . $currentUser->id);
            }
            if($currentUser->isTrial())
            {
                $this->flash('Your account is not verified, Please verify within '. (7 - $currentUser->trialDays()) .' days');
                $this->mailer->sendConfirmationMailTo($currentUser, $currentUser->code);
            }
            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return 'These credentials do not match our records.';
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect('/login');
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (property_exists($this, 'redirectPath'))
        {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/login';
    }

    /**
     * Return the account of the admin
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @internal param User $user
     */
    public function getHome()
    {
        $user = \Auth::user();
        $admin_schools = null;
        $client_schools = null;
        $administrator = \App\Administrator::where('user_id', $user->id)->first();
        $clients = \App\Client::where('user_id' , $user->id)->get();
        if($administrator != null)
        {
            $admin_schools = \App\School::where('id', $administrator->school_id)->first();
        }

        //dd($client_schools);
        $schools = \Auth::user()->schools()->get();
        //dd($schools->count());
        return view('dashboard.index', compact('admin_schools','schools','clients'));
    }

    /**
     * Generate a list of the school the user owns
     * @return \Illuminate\View\View
     */
    public function getSchools()
    {
        $title = "Groups";
        $schools = $this->groupsForUser();
        return view('school.inspina.schools', compact('title', 'schools'));
    }

    public function showSchool($group)
    {
        $title = $group->name;
        return view('inspina.profile.school' , compact('title','groups'));
    }



    public function getCreateSchool()
    {
        return $this->view('school.inspina.create', 'New School');
    }

    public function postCreateSchool(CreateSchoolRequest $request, $school)
    {
        $user =\Auth::user();
        $user->schools()->create($request->all());
        return redirect('/schools');
    }

    /**
     * @param $school
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @internal param $user
     */
    public function deleteSchool($school)
    {
        $school->delete();
        return redirect('/schools');
    }

    public function updateSchool($school, Request $request)
    {
        $school->fill($request->input())->save();
        return redirect($school->username);
    }





    public function getActivate($user)
    {
        if(!$user)
            return redirect('/login')->withErrors('Could not activate your account. Wrong code or account has already been activated.');

        $user->active = 1;
        $user->code = '';
        $user->save();
        $this->auth->login($user);
        return redirect('/');
    }
    /*_________________________________________________________________________________________________________*/
    /* School Messenger Routes */
    public function getSchoolMessages()
    {
        $schools = \Auth::user()->schools()->get();
        return view('school.account.messenger', compact('user', 'schools'));
    }

    public function viewSchool($group)
    {
        $title = $group->name;
        return view('inspina.update.school', compact('title', 'groups'));
    }
    public function postSchoolMessages()
    {

    }

}