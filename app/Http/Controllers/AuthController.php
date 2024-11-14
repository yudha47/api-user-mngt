<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  public function test(){
    $user = ['name' => 'yudha niagara'];

    $response = [
      'responseCode' => 200000,
      'responseMessage' => 'Success',
      'responseData' => $user
    ];

    return response()->json($response, 200);
  }
  
  public function login(Request $request){
    $validator = Validator::make($request->all(), [
        'user_email' => 'required|email',
        'user_password' => 'required|min:8'
    ]);

    if ($validator->fails()) {$response = [
        'responseCode' => 400001,
        'responseMessage' => 'Please check email & password'
      ];

      return response()->json($response, 400);
    }

    $userCheck = User::select('user_id', 'user_fullname', 'user_email', 'user_status', 'user_password')->where('user_email', $request->user_email);
    if($userCheck->count() != 0){
      $userCount = $userCheck->count();
      $validPassword = Hash::check($request->user_password, $userCheck->first()->user_password);

      if($userCount == 1 && $validPassword){
          $userData = $userCheck->first();

          if($userData->user_status == 0){
            $response = [
              'responseCode' => 400001,
              'responseMessage' => 'Account is disable'
            ];

            return response()->json($response, 400);
          }else{
            $token = $userData->createToken('ApiToken')->plainTextToken;
            $arr_res = [
              'data' => $userData,
              'token' => $token
            ];

            $response = [
              'responseCode' => 200000,
              'responseMessage' => 'Success',
              'responseData' => $arr_res
            ];

            return response()->json($response, 200);
          }
      }else{
          $response = [
            'responseCode' => 400001,
            'responseMessage' => 'There was a problem logging in. Check your email and password or create an account.'
          ];

          return response()->json($response, 400);
      }
    }else{
      $response = [
        'responseCode' => 400001,
        'responseMessage' => 'Account not found'
      ];

      return response()->json($response, 400);
    }
  }

  public function logout(Request $request){
    $accessToken = $request->bearerToken();
    $token = PersonalAccessToken::findToken($accessToken);
    $remove_token = $token->delete();
    $response = "";
    if($remove_token){
      $response = [
          'responseCode' => 200000,
          'responseMessage' => 'User Logout.'
      ];

      return response($response, 200);
    }else{
      $response = [
          'responseCode' => 400001,
          'responseMessage' => 'There was a problem in the process, something went wrong'
      ];
                
      return response($response, 400);
    }
  }

  public function validate_token(Request $request){
    $accessToken = $request->bearerToken();
    $token = PersonalAccessToken::findToken($accessToken);
    if($token != null){
      $response = [
        'responseCode' => 200000,
        'responseMessage' => 'Token Valid'
      ];

      return response($response, 200);
    }else{
      $response = [
        'responseCode' => 400001,
        'responseMessage' => 'Token Invalid'
      ];

      return response($response, 200);
    }
  }
}
