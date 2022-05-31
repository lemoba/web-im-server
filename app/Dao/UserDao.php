<?php declare(strict_types=1);

namespace App\Dao;

use App\Model\User;

class UserDao extends BaseDao
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function findByMobile(string $mobile)
    {
        return User::query()->where('mobile', $mobile)->first();
    }
}