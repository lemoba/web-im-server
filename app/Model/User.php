<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
use Qbhy\HyperfAuth\Authenticatable;

/**
 */
class User extends Model implements Authenticatable
{
    protected $hidden = [
        'password',
        'updated_at'
    ];

    protected $fillable = [
        'username',
        'mobile',
        'password',
    ];

    protected $casts = [
        'gender'   => 'integer',
        'is_robot' => 'integer',
    ];

    public function getId()
    {
        return $this->getKey();
    }

    public static function retrieveById($key): ?Authenticatable
    {
        return self::query()->first($key);
    }
}