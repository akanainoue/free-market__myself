<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        // 登録後は一旦 profile に行かせる（未認証なら /email/verify に飛ぶ）
        return redirect('/mypage/profile');
    }
}
