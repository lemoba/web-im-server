<?php declare(strict_types=1);

namespace App\Helper;

class Hash
{
    public static function make(string $value): string
    {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    public static function verify(string $value, string $hashValue): bool
    {
        return password_verify($value, $hashValue);
    }
}