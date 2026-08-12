<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleController extends Controller
{
    // Melempar user ke halaman login Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Menangani kembalian data dari Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Cek apakah user dengan google_id ini sudah ada
            $findUser = User::where('google_id', $googleUser->id)->first();

            if ($findUser) {
                // Jika sudah ada, langsung login
                Auth::login($findUser);
                return redirect()->intended('/home');
            } else {
                // Cek apakah emailnya sudah terdaftar secara manual sebelumnya
                $existingUser = User::where('email', $googleUser->email)->first();
                
                if($existingUser) {
                    // Update akun yang lama dengan google_id
                    $existingUser->update(['google_id' => $googleUser->id]);
                    Auth::login($existingUser);
                } else {
                    // Jika benar-benar baru, buat akun baru
                    $newUser = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'role' => 'customer', // Otomatis jadi customer
                        'password' => null // Tidak butuh password
                    ]);
                    Auth::login($newUser);
                }
                
                return redirect()->intended('/home');
            }

        } catch (Exception $e) {
            return redirect('/login')->withErrors(['email' => 'Gagal login dengan Google. Silakan coba lagi.']);
        }
    }
}