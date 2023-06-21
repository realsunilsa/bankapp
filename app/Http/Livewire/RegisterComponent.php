<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class RegisterComponent extends Component
{
    public $utype;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'utype'                 => 'required',
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|string|min:6|max:255',
            'password_confirmation' => 'required|string|min:6|max:255|same:password'
        ]);
    }

    public function store()
    {
        $this->validate([
            'utype'                 => 'required',
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|string|min:6|max:255',
            'password_confirmation' => 'required|string|min:6|max:255|same:password'
        ]);

        $user = new User();

        $user->utype = $this->utype == 0 ? '0' : '1';
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->save();

        session()->flash('message', 'Account has been created successfully! 😃');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.register-component');
    }
}
