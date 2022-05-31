<?php declare(strict_types=1);


use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerInterface;

/**
 * @return ContainerInterface
 */
if (!function_exists("di")) {
    function di(): ContainerInterface {
        return ApplicationContext::getContainer();
    }
}