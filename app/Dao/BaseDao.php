<?php declare(strict_types=1);

namespace App\Dao;

use App\Model\Model;
use App\Traits\DaoTrait;

/**
 * @method Model create(array $values) 创建数据
 */
abstract class BaseDao
{
    use DaoTrait;

    public static function getInstance()
    {
        return di()->get(static::class);
    }
}