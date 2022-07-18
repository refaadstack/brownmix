<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ],[
            'name.required' => 'Masukan Nama anda',
            'name.string' => 'Nama tidak boleh berupa angka',
            'name.max' => 'Nama harus kurang dari 255 karakter',
            'email.required' => 'Harus Masukkan Email',
            'email.email' => 'Email harus valid',
            'email.max' => 'Email harus kurang dari 255 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Silahkan input ulang Password',
            'password.string' => 'Password harus bersifat kata',
            'password.confirmed' => 'Password Konfirmasi Tidak Cocok',
            'login.failed' => 'gagal!',
        ]
        )->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
