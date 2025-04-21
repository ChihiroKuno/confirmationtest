<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Http\Requests\RegisterUserRequest;

class CreateNewUser implements CreatesNewUsers
{
    public function create(array $input)
    {
        // RegisterUserRequestを直接使うには少し工夫が必要（通常はコントローラー内で使う）
        // なので、ここでは手動でバリデーションを適用

        $request = new RegisterUserRequest();
        $request->setContainer(app())->setRedirector(app('redirect'))->merge($input);


        Validator::make(
            $request->all(),
            $request->rules(),
            $request->messages()
        )->validate();
    
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}