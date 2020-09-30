<?php

namespace App\Services;

use App\User;
use App\LinkedSocialAccount;
use Laravel\Socialite\Two\User as ProviderSocailUser;
use Illuminate\Support\Facades\Response;

class SocialAccountsService
{

    /**
     * Find or create user instance by provider user instance and provider name.
     * 
     * @param ProviderUser $providerUser
     * @param string $provider
     * 
     * @return User
     */
    public function findOrCreate(ProviderSocailUser $providerUser, string $provider): User
    {
        $user = LinkedSocialAccount::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        if ($user) {
            return $user->user;
        } else {
            $user = null;

            if (!$user) {
                $user = User::create([
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'role_id' => 4,
                    'active' => true
                ]);
            }
            $user->linkedSocialAccounts()->create([
                'provider_id' => $providerUser->getId(),
                'provider_name' => $provider,
            ]);
            return $user;
        }
    }
}
