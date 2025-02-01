<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
	public function redirectToGoogle()
	{
		return Socialite::driver('google')->redirect();
	}

	public function handleGoogleCallback(Request $request)
	{
		$googleUser = Socialite::driver('google')->user();

		$user = User::where(['email' => $googleUser->email])->first();

		if (!$user) {
			$user = User::create([
				'username' => $googleUser->name,
				'password' => Str::password(12),
				'email' => $googleUser->email,
				'google_id' => $googleUser->token,
				'avatar' => $googleUser->refreshToken,
				'email_verified_at' => now(),
			]);
		}else {
			$user->update([
				'google_id' => $googleUser->id,
				'avatar' => $googleUser->avatar,
				'email_verified_at' => now(),
			]);
		}

		Auth::login($user);

		return redirect(route('dashboard'));
	}
}
