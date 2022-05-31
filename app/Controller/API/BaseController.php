<?php declare(strict_types=1);

namespace App\Controller\API;

use App\Controller\AbstractController;
use App\Exception\ValidateException;
use App\Helper\CodeResponse;
use App\Model\User;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

class BaseController extends AbstractController
{
    protected function codeReturn(array $codeResponse, $data = null, string $info = '')
    {
        [$code, $msg] = $codeResponse;
        $res = ['code' => $code, 'msg' => $info ?: $msg];
        if (!is_null($data)) {
            $res['data'] = $data;
        }
        return $this->response->json($res);
    }

    protected function success($data = null)
    {
        return $this->codeReturn(CodeResponse::SUCCESS, $data);
    }

    protected function message(array $codeResponse = CodeResponse::SUCCESS)
    {
        return $this->codeReturn($codeResponse);
    }

    protected function fail(array $codeResponse = CodeResponse::FAIL, $info = '')
    {
        return $this->codeReturn($codeResponse, null, $info);
    }

    protected function failOrSucess($isSuceess, array $codeResponse = CodeResponse::FAIL, $data = null, $info = '')
    {
        if ($isSuceess) {
            return $this->success($data);
        } else {
            return $this->fail($codeResponse, $info);
        }
    }

    protected function validate(...$args)
    {
        $validator = di()->get(ValidatorFactoryInterface::class)->make(...$args);
        if ($validator->fails()) {
            throw new ValidateException($validator->errors()->first(), CodeResponse::VALIDATION_ERROR);
        }
    }

    /**
     * 获取用户信息
     * @return User
     */
    protected function getUser(): ?User
    {
        $guard = $this->guard();
        return $guard->check() ? $guard->user() : null;
    }

    /**
     * 获取用户ID
     * @return int
     */
    protected function getUid(): int
    {
        $guard = $this->guard();
        return $guard->check() ? $guard->user()->getId() : 0;
    }
    /**
     * 获取授权守卫
     * @return mixed|\Qbhy\HyperfAuth\AuthGuard|\Qbhy\HyperfAuth\AuthManager
     */
    protected function guard()
    {
        return auth('jwt');
    }
}