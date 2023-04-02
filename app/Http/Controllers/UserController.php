<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'name.required' => 'Please provide your name.',
            'email.required' => 'Please provide your email address.',
            'email.email' => 'Please provide a valid email address.',
            'password.required' => 'Please provide a password.',
        ]);
        $errors = $validator->errors()->toArray();;

        $errors = array_map(function ($messages) {
            return $messages[0];
        }, array_values($errors));


        if ($validator->fails()) {
            return response()->json([
                'errors' => $errors,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // check if user already existe or not :
        $user = User::where("email", $request->input('email'))->first();
        if ($user) {
            return  response()->json([
                'errors' =>
                ["user already existe !"]

            ],  Response::HTTP_BAD_REQUEST);
        } else {
            // create user :
            $user =  User::create([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);


            $token = $user->createToken('Token Name')->plainTextToken;

            return response([
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "token" => $token
            ], Response::HTTP_CREATED);
        }
    }


    public function login(Request $request)
    {

        // verfiy is user existe or not :
        if (!Auth::attempt($request->only('email', 'password'))) {
            return  response()->json([
                'errors' =>
                ["Invalid credentials !"]
            ],   Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken('Token Name')->plainTextToken;

        return response([
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "token" => $token
        ], Response::HTTP_OK);
    }
}
