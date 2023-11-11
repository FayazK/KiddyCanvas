<?php

namespace App\Http\Controllers\Ai;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AuthController
 * @package App\Http\Controllers\Ai
 */
class AuthController extends Controller
{

    /**
     * Login user and create token
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login( Request $request )
    {
        $credentials = $request->only( 'email', 'password' );
        if( auth()->attempt( $credentials ) ) {
            $token = auth()->user()->createToken( 'authToken' )->plainTextToken;
            return new JsonResponse( [
                'token' => $token,
                'user'  => auth()->user()
            ] );
        }
        // return with json response and error message
        return new JsonResponse( [
            'message' => 'Invalid credentials'
        ], 401 );
    }// login

    /**
     * @param UserRegisterRequest $request
     *
     * @return JsonResponse
     */
    public function register( UserRegisterRequest $request )
    {
        $name = $request->name;
        $email = $request->email;
        $password = bcrypt($request->password);

        User::create( [
            'name'     => $name,
            'email'    => $email,
            'password' => bcrypt( $password ),
        ] );

        return new JsonResponse( [
            'message' => 'Registration successful. You can now login.'
        ], 201 );

    }// register

}// AuthController
