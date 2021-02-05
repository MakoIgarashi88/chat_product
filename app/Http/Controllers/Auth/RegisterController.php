<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Board;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'min:4', 'unique:users', 'regex:/^[a-zA-Z0-9-]+$/'],
            // 'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        $messages = [
            'name.required' => '必須入力です',
            'name.string' => '英数字で入力してください',
            'name.max' => '255文字以内で入力してください',
            'name.min' => '4文字以上で入力してください',
            'name.unique' => '既に登録されているIDです',
            'name.regex' => '英数字で入力してください',
            'password.required' => '必須入力です',
            'password.string' => '英数字で入力してください',
            'password.min' => '8文字以上の英数字で入力してください',
            'password.confirmed' => '入力されたパスワードが一致していません',

        ];
        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'nickname' => $data['nickname'],
                // 'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'api_token' => Str::random(60),
            ]);
            $board = new Board;
            $board->user_id = $user->id;
            $board->name = "掲示板にタイトルをつけてください";
            $board->detail = "気になる話題や趣味を書いて、自己紹介してみよう";
            $board->save();

            return $user;
        });
    }
}
