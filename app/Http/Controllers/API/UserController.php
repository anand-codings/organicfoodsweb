<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use File;
use App\Category;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public $successStatus = 200;
    
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email|exists:users',
                    'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return sendError('Invalid Username or Password', 401);
        }

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $id = $user->id;
            $user['data'] = User::find($id);
            $user['data']->session_token = $user->session_token;
            $success = $user['data'];
            return sendSuccess('Login Successfull', $success);
        } else {
            return sendError('Login Failed.', 401);
        }
    }
    
    
     /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
            
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required',
                    'c_password' => 'required|same:password',
                    'phone' => 'required',
                    
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages()->all();
            $messages = join("\n", $messages);
            return Response::json(array('status' => 'error', 'errorMessage' => $messages), '200');
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $user->session_token = $user->createToken('OrganicFoods')->accessToken;
        $user->save();
        $id   = $user->id;
        $user['data'] = User::find($id);
        $success = $user;

         return Response::json(array('status' => 'success', 'successMessage' => 'Registeration Successfull', 'successData' => $success), 200, []);
    }
    
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json([
                    'message' => 'Successfully logged out'
        ]);
    }
    
    
    public function getCategories(){
        $data['categories'] = Category::all();
        $success = $data;
        return Response::json(array('status' => 'success', 'successMessage' => 'List of Categories', 'successData' => $success), 200, []);
    }
}
