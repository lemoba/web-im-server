<?php declare(strict_types=1);

namespace App\Exception;

use Hyperf\Server\Exception\ServerException;

class BusinessException extends ServerException
{
    public function __construct(array $codeResponse, string $info = '')
    {
        [$code, $msg] = $codeResponse;
        parent::__construct($info ?: $msg, $code);
    }
}