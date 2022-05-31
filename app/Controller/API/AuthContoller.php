<?php declare(strict_types=1);

namespace App\Controller\API;

use App\Service\UserService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Controller(prefix: '/api/auth')]

class AuthContoller extends BaseController
{
    #[Inject]
    protected UserService $userService;

    #[PostMapping(path: 'login')]
    public function login(RequestInterface $request)
    {
        $params = $request->all();
        $this->validate($params, [
            'mobile' => 'required|min:11|max:11',
            'password' => 'required',
        ]);

        $user = $this->userService->login($params['mobile'], $params['password']);

        try {
            $token = $this->guard()->login($user);
        }catch (\Exception $e) {
            $this->fail($e->getMessage());
        }


        $res = [
            'type' => 'Bearer',
            'access_token' => $token,
            'expires_in'   => $this->guard()->getJwtManager()->getTtl()
        ];

        return $this->success($res);
    }

    #[PostMapping(path: 'register')]
    public function register(RequestInterface $request)
    {
        $params = $request->all();
        $this->validate($params, [
            'username' => 'required|max:20',
            'mobile' => 'required|min:11|max:11',
            'sms_code' => 'required|digits:5',
            'password' => 'required|min:5|max:20',
        ]);

        //TODO 短信验证码

        // 注册
        $res = $this->userService->register($params);

        return $this->failOrSucess($res);
    }

    public function forget()
    {

    }
}
