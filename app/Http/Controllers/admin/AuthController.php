<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
  public function loginView() {
        if (Auth::guard('admin')->check()) {
            return view('admin.dashboard_content');
//            return redirect('admin_dashboard?signup_stats_filter=daily');
        } else {
            $data['title'] = 'Admin Login';
            return view('admin.login', $data);
        }
    }

   public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $auth = auth()->guard('admin');
        if ($auth->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('admin.dashboard');
//            return redirect('admin_dashboard?signup_stats_filter=daily');
        } else {
            Session::flash('error', 'Invalid email or password.');
            return Redirect::to(URL::previous());
        }
    }
    public function showDashboard()
    {
        return view('admin.dashboard_content');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
