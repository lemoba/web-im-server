<?php declare(strict_types=1);

namespace App\Helper;

class CodeResponse
{
    // 通用返回码
    const SUCCESS = [200, '成功'];
    const FAIL = [400, '错误'];
    const NO_LOGIN = [501, "请登录"];
    const UPDATED_FAIL = [505, "更新失败"];
    const PARMA_ILLEGAL = [401, '参数错误'];

    const REGISTER_FAIL = [410, '注册失败'];
    const MOBILE_EXISTS = [411, '账号已存在'];
    const MOBILE_NOT_EXISTS = [412, '账号不存在'];

    const VALIDATION_ERROR = 301;
}