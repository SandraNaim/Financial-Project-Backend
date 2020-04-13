<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;
class ApiController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function register(Request $request)
    {
         // dd()
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->currency_id = $request->currency_id;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }

    public function getCurrentUser(){
        try {
           $user = JWTAuth::parseToken()->authenticate();

            return response()->json([
                'success' => true,
                'data' => $user
            ]);
        } catch ( JWTException $error ) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user isn\'t logged in'
            ], 500);
        }
    }

     
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
 
            $inputs = $request->all();

        $user = user::where('id',$user->id)->first();
        $user->first_name = $inputs['first_name']; 
        $user->last_name = $inputs['last_name'];
        $user->currency_id= $inputs['currency_id'];
        if(isset($inputs['password'])){
            $user->password = bcrypt($inputs['password']);
        }

 
        if ($user->save()){ 
            return response()->json([
                'success' => true,
                'data' => $user
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, income could not be updated.'
            ], 500);
        }
         } catch ( JWTException $error ) {
             return response()->json([
                 'success' => false,
                 'message' => 'Sorry, the user isn\'t logged in'
             ], 500);
         }

        
    }

}