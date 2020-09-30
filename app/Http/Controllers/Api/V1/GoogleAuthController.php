<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\SocialUserResolver;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    private $socialUserResolver;

    public function __construct(SocialUserResolver $socialUserResolver)
    {
        $this->socialUserResolver = $socialUserResolver;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function loginUrl(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {

            // assign access token to user
            $token = $this->issueToken($existingUser);
            return Response::json([
                'response_hehe' => $request->all(),
                'user_on_google' => $user,
                'user_on_system' => $existingUser,
                'token_system' => $token
            ]);
        } else {
            // create a new user
            return Response::json([
                'data_google_user' => $user
            ]);
        }
    }

    public function loginCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $authGoogleUser = $this->socialUserResolver->resolveUserByProviderCredentials('google', $googleUser->token);

        if (!$authGoogleUser->active) {
            return Response::json([
                'error' => "Your account has been blocked",
            ], 403);
        }

        $token =  $this->issueToken($authGoogleUser);
        return redirect('http://localhost:8080/signin?access_token=' . $token['access_token']);
    }

    public function checkGoogleAuth(Request $request)
    {
        $userGoogle = $this->socialUserResolver->resolveUserByProviderCredentials('google', $request->input('access_token'));

        return Response::json([
            'user_google' => $userGoogle,
            // 'user_system' => $existingUser
        ]);
    }

    public function issueToken(User $user)
    {

        $userToken = $user->token() ?? $user->createToken('Social Login');

        return [
            "token_type" => "Bearer",
            "access_token" => $userToken->accessToken
        ];
    }

    /**
     * Method for testing
     * 
     * @param $id (user id) 
     * @return mixins
     */
    public function generateTokenByUserId($id)
    {
        $user = \App\User::findOrFail($id);

        return [
            "token_type" => "Bearer",
            "access_token" => $user->createToken('Unsocial Login')
        ];
    }
}
