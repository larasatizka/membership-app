<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Article;
use App\Models\Video;

class AuthController extends Controller
{
    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle manual registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'membership' => 'required|in:A,B,C',
        ]);

        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'membership' => $request->membership,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle manual login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout(); // Hapus sesi login
        $request->session()->invalidate(); // Hancurkan semua sesi
        $request->session()->regenerateToken(); // Amankan dari CSRF

        return redirect('/login')->with('status', 'Berhasil logout.');
    }

    // Redirect to Google
    public function redirectToGoogle()
    {
        //dd(Socialite::driver('google')->redirect());
        return Socialite::driver('google')
        ->with(['prompt' => 'select_account'])
        ->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        return $this->handleSocialCallback('google');
    }

    // Redirect to Facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Handle Facebook callback
    public function handleFacebookCallback()
    {
        return $this->handleSocialCallback('facebook');
    }

    // Handle Google/Facebook callback logic
    protected function handleSocialCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        // Cari user berdasarkan email terlebih dahulu
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // Update provider info jika belum tersimpan
            $user->update([
                'provider'    => $provider,
                'provider_id' => $socialUser->getId(),
            ]);
        } else {
            // Buat user baru
            $user = User::create([
                'name'        => $socialUser->getName() ?? $socialUser->getNickname(),
                'email'       => $socialUser->getEmail(),
                'provider'    => $provider,
                'provider_id' => $socialUser->getId(),
                'membership'  => 'A', // default membership
            ]);
        }

        Auth::login($user);
        return redirect('/dashboard');
    }


    // Dashboard konten berdasarkan membership
    public function dashboard()
    {
        $user = Auth::user();

        switch ($user->membership) {
            case 'A':
                $articles = Article::limit(3)->get();
                $videos   = Video::limit(3)->get();
                break;
            case 'B':
                $articles = Article::limit(10)->get();
                $videos   = Video::limit(10)->get();
                break;
            case 'C':
            default:
                $articles = Article::all();
                $videos   = Video::all();
                break;
        }

        return view('dashboard', compact('articles', 'videos', 'user'));
    }

    public function updateMembership(Request $request)
    {
        $request->validate([
            'membership' => 'required|in:A,B,C',
        ]);

        $user = Auth::user();
        $user->membership = $request->membership;
        $user->save();

        return redirect()->back()->with('success', 'Membership berhasil diperbarui!');
    }
}
