<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    // Tambahkan rules untuk validasi
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        // Jalankan validasi
        $this->validate();

        // Cek kredensial
        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            // Jika kredensial salah, kirim error
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // Jika berhasil, alihkan ke dashboard
        return redirect()->intended(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.login')
                ->layout('layouts.guest'); // Gunakan layout yang sudah ada
    }
}