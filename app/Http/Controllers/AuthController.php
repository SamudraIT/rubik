<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function renderLogin()
    {
        return view('pages.auth.login');
    }

    public function renderRegister()
    {
        return view('pages.auth.register');
    }

    public function renderReset()
    {
        return view('pages.auth.forget-password');
    }

    public function resetPassword(Request $request)
    {
        $card_number = $request->card_number;

        $find_profile = Profile::where('card_number', $card_number)->first();

        if (!$find_profile) {
            toastr()->error('Akun tidak di temukan di aplikasi kami');
            return redirect('dashboard/reset-password');
        }

        toastr()->success('Anda akan segera di alihkan ke form reset');
        return redirect()->route('change-password', ['card_number' => $card_number]);
    }

    public function renderChange(Request $request)
    {
        $card_number = $request->query('card_number');
        return view('pages.auth.change-password', compact('card_number'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

        $card_number = $request->card_number;

        $find_profile = Profile::where('card_number', $card_number)->first();

        $find_user = User::where('id', $find_profile['user_id'])->first();

        $hashedPassword = Hash::make($request->password);

        $find_user->update(['password' => $hashedPassword]);

        toastr()->success('Password berhasil diubah');

        return redirect('/dashboard/login');

    }

}
