<?php declare(strict_types=1);

namespace App\Service;

use App\Dao\UserDao;
use App\Exception\BusinessException;
use App\Helper\CodeResponse;
use App\Helper\Hash;
use Hyperf\Di\Annotation\Inject;

class UserService
{
    #[Inject]
    protected UserDao $userDao;

    /**
     * 账号注册
     * @param  array  $params
     * @return bool
     */
    public function register(array $params): bool
    {
        $user = $this->userDao->findByMobile($params['mobile']);
        $params['password'] = Hash::make($params['password']);
        if ($user) {
            // 账号已存在
            throw new BusinessException(CodeResponse::MOBILE_EXISTS);
        }
        if ($this->userDao->create($params)) {
            return true;
        }
        return false;
    }

    /**
     * 用户登录
     * @param  string  $mobile
     * @param  string  $password
     * @return \Hyperf\Database\Model\Builder|\Hyperf\Database\Model\Model|object
     */
    public function login(string $mobile, string $password)
    {
        $user = $this->userDao->findByMobile($mobile);
        if (!$user) {
            throw new BusinessException(CodeResponse::MOBILE_NOT_EXISTS);
        }

        if (!Hash::verify($password, $user->password)) {
            throw new BusinessException(CodeResponse::PARMA_ILLEGAL, '账号或密码错误');
        }
        return $user;
    }
}