<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class AuthController extends Controller
{
    /**
     * Show the application's farmer login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showFarmerLoginForm()
    {

        return view('farmer.login');
    }

    /**
     * Show the application's admin login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Show the application farmer registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showFarmerRegistrationForm()
    {
        return view('farmer.register');
    }

    public function userLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $status = User::select('is_active')
                                ->where('email', $request['email'])
                                ->where('type', 'user')
                                ->first();
        if ($status->is_active == 0) {
            return Redirect::to(URL::previous())->with('error', 'Your Account is Disable.')->withInput();
        }
        $remember_me = $request->input('remember_me') ? TRUE:FALSE;
//        $auth = auth()->guard('admin');
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password') , 'is_active'=> 1], $remember_me)) {
            Session::flash('success', 'Login Success');
            return redirect()->route('home');
        } else {
            Session::flash('error', 'Invalid email/password or inactive.');
            return Redirect::to(URL::previous());
        }
    }

    public function FarmerLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $status = User::select('is_active')
                                ->where('email', $request['email'])
                                ->where('type', 'farmer')
                                ->first();
        if ($status->is_active == 0) {
            return Redirect::to(URL::previous())->with('error', 'Your Account is Disable.')->withInput();
        }
        $remember_me = $request->input('remember_me') ? TRUE:FALSE;
        $auth = auth()->guard('farmer');
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password') , 'is_active'=> 1, 'type'=> 'farmer'], $remember_me)) {
            Session::flash('success', 'Login Successfully');
            return redirect()->route('farmer.dashboard');
        } else {
            Session::flash('error', 'Invalid email/password .');
            return Redirect::to(URL::previous());
        }
    }

    public function farmerLogout()
    {
        Auth::guard('farmer')->logout();
        return \redirect()->route('farmer.login');
    }

    public function farmerRegistration(Request $request) {
        $request->validate([
            'name' => 'required',
//            'last_name' => 'required',
            'email' => 'required | email',
            'password' => 'required | min:6 | confirmed',
            'password_confirmation' => 'required'
        ]);
        $check_user = User::where('email', $request['email'])->first();
        if ($check_user) {
            return Redirect::to(URL::previous())->with('error', 'Email Already Taken.')->withInput();
        }
        $user = User::where('email', $request['email'])->first();
        if (!$user) {
            $user = new User;
            $user->name = $request['name'];
            $user->email = $request['email'];
        }
        $user->password = bcrypt($request['password']);
        $user->last_login = Carbon::now();
        $user->type = 'farmer';
        $user->is_web = 1;
//        $location = json_decode(file_get_contents('http://api.ipstack.com/' . \Request::ip() . '?access_key=a8dd21ef5b997c650ce9b402b5538960'));
////        dd($location);
//        if ($location) {
//            $user->lat = $location->latitude;
//            $user->lng = $location->longitude;
//            $user->country = $location->country_name;
//            $user->city = $location->city;
//            $user->zip_code = $location->zip;
//        }

        $user->lat = $request['lat'] ? $request['lat'] : 0;
        $user->lng = $request['long'] ? $request['long'] : 0;

        $user->save();
//        $viewData['name'] = $user->first_name . ' ' . $user->last_name;
//        Mail::send('emails.register', $viewData, function ($m) use ($user) {
//            $m->from(env('FROM_EMAIL'), 'Musician App');
//            $m->to($user->email, $user->first_name)->subject('Confirmation Email');
//        });
        $auth = auth()->guard('user');
        $remember = $request['remember_me'] ? TRUE:FALSE;
        if ($auth->attempt(['password' => $request['password'], 'email' => $request['email']],$remember)) {
            Session::flash('success', 'Register Successfully, Please Login');
            return redirect()->route('farmer.login');
//            return redirect()->route('route.name', [$param]); redirect with paramer
        }
        return Redirect::to(URL::previous());
    }

    public function userRegistration(Request $request) {
        $request->validate([
            'name' => 'required',
//            'last_name' => 'required',
            'email' => 'required | email',
            'password' => 'required | min:6 | confirmed',
            'password_confirmation' => 'required'
        ]);
        $check_user = User::where('email', $request['email'])->first();
        if ($check_user) {
            return Redirect::to(URL::previous())->with('error', 'Email Already Taken.')->withInput();
        }
        $user = User::where('email', $request['email'])->first();
        if (!$user) {
            $user = new User;
            $user->name = $request['name'];

            $user->email = $request['email'];
        }
        $user->password = bcrypt($request['password']);
        $user->last_login = Carbon::now();
        $user->type = 'user';
        $user->is_web = 1;
        $user->lat = $request['lat'] ? $request['lat'] : 0;
        $user->lng = $request['long'] ? $request['long'] : 0;

        $user->save();
        $auth = auth()->guard('user');
        $remember = $request['remember_me'] ? TRUE:FALSE;
        if ($auth->attempt(['password' => $request['password'], 'email' => $request['email']],$remember)) {
            Session::flash('success', 'Register Successfully, Please Login');
            return redirect()->route('login');
        }
        return Redirect::to(URL::previous());
    }



}
