<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use App\Exception\Handler\BusinessExceptionHandler;
use App\Exception\Handler\ValidateExceptionHandler;

return [
    'handler' => [
        'http' => [
            Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler::class,
            ValidateExceptionHandler::class,
            BusinessExceptionHandler::class,
            App\Exception\Handler\AppExceptionHandler::class,
            Hyperf\Validation\ValidationExceptionHandler::class,
        ],
    ],
];
