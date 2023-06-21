<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginComponent extends Component
{
    public $email;
    public $password;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);
    }

    public function authcheck()
    {
        $this->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        $user = User::where(['email' => $this->email])->first();
        if ($user) {
            if (Hash::check($this->password, $user->password)) {
                $accessToken = Str::random(36);
                $user->access_token = $accessToken;
                $user->save();
                Auth::login($user);
                session()->flash('message', 'Welcome to your control panel 😃');
                return redirect()->route('home.index');
            } else {
                session()->flash('e-message', 'Invalid Password 😥');
            }
        } else {
            session()->flash('e-message', 'No account found with this Email 😥');
        }
    }

    public function render()
    {
        return view('livewire.login-component');
    }
}
