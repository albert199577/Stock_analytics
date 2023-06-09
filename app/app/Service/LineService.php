<?php
namespace App\Service;

use GuzzleHttp\Client;
use App\Http\Controllers\Auth\RegisterController as Register;
use App\Http\Controllers\Auth\LoginController as Login;

class LineService
{
    private $client;

    function __construct()
    {
        $this->client = new Client;
    }

    public function getLoginBaseUrl()
    {
        $url = config('line.authorize_base_url');

        $arr = [
            'response_type' => 'code',
            'client_id' => config('line.channel_id'),
            'redirect_uri' => route('line.callback'),
            'state' => 'member',
            'scope' => 'profile openid email',
        ];
        $url = $url . http_build_query($arr);

        return $url;
    }

    public function getLineToken($code)
    {
        $response = $this->client->request(
            'POST',
            config('line.get_token_url'),
            ['form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => route('line.callback'),
                'client_id' => config('line.channel_id'),
                'client_secret' => config('line.secret')
            ]]
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getUserProfile($token)
    {
        $response = $this->client->request(
            'POST',
            config('line.get_user_profile_url'),
            ['form_params' => [
                'id_token' => $token,
                'client_id' => config('line.channel_id'),
            ]]
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    public function registerByLine($userProfile)
    {
        $user = new Register;
        $user->register($userProfile);
    }

    public function loginByLine($userProfile)
    {
        $user = new Login;
        $user->login($userProfile);
    }
}