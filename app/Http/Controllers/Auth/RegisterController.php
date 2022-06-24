<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */




    // use RegistersUsers;

    // /**
    //  * Where to redirect users after registration.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    // /**
    //  * Get a validator for an incoming registration request.
    //  *
    //  * @param  array  $data
    //  * @return \Illuminate\Contracts\Validation\Validator
    //  */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    // /**
    //  * Create a new user instance after a valid registration.
    //  *
    //  * @param  array  $data
    //  * @return \App\Models\User
    //  */
    // protected function create(array $data)
    // {
    //     // dd($data);
    //     $user = User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);

    //     $token = $user->createToken('myapptoken')->plainTextToken;

    //     $response = [
    //         'user' => $user,
    //         'token' => $token
    //     ];
    //     return response($response, 201);
    // }


    public function register(Request $request)
    {
        // dd('sad');

            $post_data = $request->validate([
                    'name'=>'required|string',
                    'email'=>'required|string|unique:users,email',
                    'password'=>'required|string|confirmed'
            ]);

            $rem = Str::random(60);
            // dd($rem);
 
            $user = User::create([
            'name' => $post_data['name'],
            'email' => $post_data['email'],
            'password' => Hash::make($post_data['password']),
            'remember_token' => $rem,
            ]);
            
            $token = $user->createToken('myAppToken')->plainTextToken;
 
            $response = [
            'user' => $user,
            'token' => $token
            ];

            return response ($response, 201);
        }

        public function login(Request $request){
            if (!\Auth::attempt($request->only('email', 'password'))) {
                   return response()->json([
                    'message' => 'Login information is invalid.'
                  ], 401);
            }
     
            $user = User::where('email', $request['email'])->firstOrFail();
            // dd($user);
            // $token = $request->bearerToken();
            // dd($token);
            // $token = $user->createToken('authToken')->plainTextToken;
            $token = $user->createToken('myAppToken')->plainTextToken;
     
                return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                ]);
            }
}
