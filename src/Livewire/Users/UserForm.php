<?php

namespace Nkls\Tables\Livewire\Users;

use Livewire\Form;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

class UserForm extends Form
{
    #[Validate('required|min:3')]
    public $name;

    #[Validate('required|email|unique:users,email')]
    public $email;

    public $avatar = 'no_avatar.png';

    #[Validate('required|min:3')]
    public $tel;

    public function save()
    {
        $faker = Faker::create();

        //transaction needed
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => now(),
            'password' => Hash::make('zontik'),
            'remember_token' => Str::random(60),
        ]);

        Profile::create([
            'user_id' => $user->id,
            'avatar' => $this->avatar,
            'status' => $faker->randomElement(['active', 'inactive', 'deleted']),
            'country' => $faker->country,
            'tel' => $this->tel
        ]);
    }
}
