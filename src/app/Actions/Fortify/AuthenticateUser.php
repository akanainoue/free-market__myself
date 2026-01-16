<?php

namespace App\Actions\Fortify;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticateUser
{
    public function __invoke($request)
    {
        // 👇 LoginRequest の rules/messages を流用
        Validator::make(
            $request->all(),
            (new LoginRequest)->rules(),
            (new LoginRequest)->messages()
        )->validate();

        if (! Auth::attempt(
            $request->only('email','password'),
            $request->boolean('remember')
        )) {
            throw ValidationException::withMessages([
                'email' => 'メールアドレスかパスワードが違います',
            ]);
        }

        $request->session()->regenerate();

        return  Auth::user();
    }
}
//0から自作クラス　FortifyServiceProvider(ログインアクションカスタマイズ)
//__invoke はクラスを“関数化”するスイッチ

// AuthenticateUser は 未入力時は呼ばれない
// Fortify内部
// $this->validateLogin($request);   ← ここで required チェック
// $user = authenticateUsing($request);
// この validateLogin() が 先に実行される ため
// required メッセージは
// 👉 resources/lang/ja/validation.php で上書きする

//このファイルは無意味