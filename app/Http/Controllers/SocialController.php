<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller

{


    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();

        $newUser = User::firstOrCreate([
                'email' => $user->getEmail()
            ], [
                'email_verified_at' => now(),
                'name' => $user->getName(),
                'status' => true,
                'provider' => $provider,
                'provider_id' => $user->getId(),
        ]);

        Auth::login($newUser);

        return redirect(env('SPA_URL') . '/registration-followup');
    }

    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            return response()->json(['error' => 'Please login using facebook or google'], 422);
        }
    }
}


/*public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        $hashed_random_password =Hash::make(Str::random(16));

        $users  =   User::where(['email' => $user->getEmail()])->first();
        if($users){
            Auth::login($users);
            return new UserResource(Auth::user());
        }else{
            $userCreated = User::firstOrCreate(
                [
                    'email' => $user->getEmail(),
                    'password' => $hashed_random_password,
                ],
                [
                    'email_verified_at' => now(),
                    'name' => $user->getName(),
                    'status' => true,
                ]
            );
            $userCreated->providers()->updateOrCreate(
                [
                    'provider' => $provider,
                    'provider_id' => $user->getId(),
                ],
                [
                    'avatar' => $user->getAvatar()
                ]
            );
             Auth::login($userCreated);

        return new UserResource(Auth::user());
        }


*/