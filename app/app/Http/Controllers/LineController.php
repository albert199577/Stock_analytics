<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\LineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LineController extends Controller
{
    private $LineService;

    function __construct()
    {
        $this->LineService = new LineService;
    }

    public function Login()
    {
        $url = $this->LineService->getLoginBaseUrl();
        echo $url;
        return redirect($url);
    }

    public function callback(Request $request)
    {
        $code = $request->input('code', '');
        // 拿取line user id token 
        $response = $this->LineService->getLineToken($code);
        
        $token = $response['id_token'];

        // 用 user id token 換取 user profile
        $userProfile = $this->LineService->getUserProfile($token);


        // 利用 user profile 與 本地 application mapping 註冊新的會員
        $data = [
            '_token' => csrf_token(),
            'name' => $userProfile['name'],
            'email' => $userProfile['email'],
            'password' => $userProfile['sub'],
            'password_confirmation' => $userProfile['sub'],
        ];

        
        $request->request->remove('code');
        $request->request->remove('state');

        $request->request->add($data);

        // 檢查是否為重複line user
        $user = user::where('email', $userProfile['email'])->get()->toArray();

        // 重複 user 導向 login
        if (!empty($user)) {
            $this->LineService->loginByLine($request);
        // 不重複 導向register
        } else {
            $this->LineService->registerByLine($request);
        }

        return redirect()->route('login');
    }
}