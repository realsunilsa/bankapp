<?php

use App\Http\Livewire\BankerDashboardComponent;
use App\Http\Livewire\CustomerDashboardComponent;
use App\Http\Livewire\HomeComponent;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\LoginComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\RegisterComponent;


Route::get('/', HomeComponent::class)->name('home.index');

Route::middleware(['guest'])->group(function () {
    Route::get('/register', RegisterComponent::class)->name('register');
    Route::get('/login', LoginComponent::class)->name('login');
});

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', function () {
        $user = Auth::user();
        $user->access_token = null;
        $user->save();
        Auth::logout();
        return redirect('/');
    })->name('logout');

    //For Customer
    Route::middleware(['authcustomer'])->group(function () {
        Route::get('/customer/dashboard', CustomerDashboardComponent::class)->name('customer.dashboard');
    });

    //For Banker
    Route::middleware(['authbanker'])->group(function () {
        Route::get('/banker/dashboard', BankerDashboardComponent::class)->name('banker.dashboard');
    });
});
