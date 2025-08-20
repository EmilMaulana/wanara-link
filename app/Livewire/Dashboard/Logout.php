<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout(); // hapus session user
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login'); // arahkan ke halaman login
    }

    public function render()
    {
        return view('livewire.dashboard.logout');
    }
}
