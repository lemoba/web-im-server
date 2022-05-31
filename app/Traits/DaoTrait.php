<?php

namespace App\Traits;

use Hyperf\Database\Model\Model;
use Hyperf\Database\Query\Builder;
use Hyperf\DbConnection\Db;
use Hyperf\Utils\Arr;

trait DaoTrait
{
    /**
     * BaseDao 构造函数
     * @param Model $model
     */
    public function __construct(
        private Model $model
    ) {}

    /**
     * 获取模型实例
     * @return Model
     */
    final public function getModel(): Model
    {
        return $this->model;
    }
    /**
     * 调用Dao的方法
     * @param  string  $method
     * @param  array  $args
     * @return mixed
     * @throws \Exception
     */
    public function __call(string $method, array $args)
    {
        // 不需要搜索条件
        return (new $this->model)->{$method}(...$args);
        throw new \Exception("Uncaught Error: Call to undefined method {$method}");
    }
}