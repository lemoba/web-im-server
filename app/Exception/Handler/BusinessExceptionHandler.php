<?php declare(strict_types=1);

namespace App\Exception\Handler;

use App\Exception\BusinessException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class BusinessExceptionHandler extends ExceptionHandler
{

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $data = json_encode([
            'code' => $throwable->getCode(),
            'msg' => $throwable->getMessage(),
        ], JSON_UNESCAPED_UNICODE);

        // 阻止异常冒泡
        $this->stopPropagation();
        return $response->withAddedHeader('content-type', 'application/json; charset=utf-8')->withStatus(200)->withBody(new SwooleStream($data));
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof BusinessException;
    }
}