<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{
    /**
     * ユーザー情報入力画面
     * 
     * @param Request $request
     */
    public function input(Request $request)
    {
        // 入力値を取得
        $params['post'] = [
            'name' => $request->input('name', ''),
            'birthday' => $request->input('birthday', ''),
        ];

        return view('user/register/input', $params);
    }

    /**
     * ユーザー情報確認画面
     * 
     * @param Request $request
     */
    public function confirm(Request $request)
    {
        // 入力値を取得
        $params['post'] = [
            'name' => $request->input('name', ''),
            'birthday' => $request->input('birthday', ''),
        ];

        return view('user/register/confirm', $params);
    }

    /**
     * ユーザー情報確定
     * 
     * @param Request $request
     */
    public function execute(Request $request)
    {
        // 入力値を取得
        $params['post'] = [
            'name' => $request->input('name', ''),
            'birthday' => $request->input('birthday', ''),
        ];

        // 現在日時の取得
        $now = (new \DateTime())->format('Y-m-d H:i:s');

        DB::table('userinfo')->insert([
            'name' => $request->input('name', ''),
            'birthday' => $request->input('birthday', ''),
            'update_time' => $now,
            'create_time' => $now,
        ]);

        return redirect()->route('user.register.complete');
    }

    /**
     * ユーザー情報完了画面
     * 
     * @param Request $request
     */
    public function complete(Request $request)
    {
        return view('user/register/complete');
    }
}
