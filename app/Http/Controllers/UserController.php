<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
  public function all_user(){
    $users = User::select('*')->get();
    $response = [
        'responseCode' => 200000,
        'responseMessage' => 'Success',
        'responseData' => $users
    ];
    
    return response()->json($response, 200);
  }

  public function user_online(){
    $user = PersonalAccessToken::all()->groupBy('tokenable_id')->count();
    $response = [
        'responseCode' => 200000,
        'responseMessage' => 'Success',
        'responseData' => $user
    ];
    
    return response()->json($response, 200);
  }

  public function add_user(Request $request){
    $validator = Validator::make($request->all(), [
        'user_fullname' => 'required',
        'user_email' => 'required|email',
        'user_password' => 'required|min:8'
    ]);

    if ($validator->fails()) {
      $response = [
        'responseCode' => 400001,
        'responseMessage' => 'Check field input'
      ];

      return response()->json($response, 400);
    }

    User::create([
      "user_fullname" => $request->user_fullname,
      "user_email" => $request->user_email,
      "user_password" => bcrypt($request->user_password)
    ]);

    $users = User::select('*')->get();
    $response = [
        'responseCode' => 200000,
        'responseMessage' => 'Success',
        'responseData' => $users
    ];
    
    return response()->json($response, 200);
  }

  public function remove_user($id){
    User::where('user_id',$id)->delete();
    $users = User::select('*')->get();
    $response = [
        'responseCode' => 200000,
        'responseMessage' => 'Success',
        'responseData' => $users
    ];
    
    return response()->json($response, 200);
  }

  public function get_user_pk($id){
    $user = User::select('*')->where('user_id', $id)->first();
    $response = [
        'responseCode' => 200000,
        'responseMessage' => 'Success',
        'responseData' => $user
    ];
    
    return response()->json($response, 200);
  }

  public function update_user(Request $request){
    $validator = Validator::make($request->all(), [
        'user_id' => 'required',
        'user_fullname' => 'required',
        'user_email' => 'required|email',
        'user_password' => 'required|min:8'
    ]);

    if ($validator->fails()) {
      $response = [
        'responseCode' => 400001,
        'responseMessage' => 'Check field input'
      ];

      return response()->json($response, 400);
    }

    User::where('user_id', $request->user_id)->update([
      "user_fullname" => $request->user_fullname,
      "user_email" => $request->user_email,
      "user_password" => bcrypt($request->user_password)
    ]);

    $users = User::select('*')->get();
    $response = [
        'responseCode' => 200000,
        'responseMessage' => 'Success',
        'responseData' => $users
    ];
    
    return response()->json($response, 200);
  }
}
