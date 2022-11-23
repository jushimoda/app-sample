<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Userinfo;

class RegisterController extends BaseController
{
    /**
     * Userinfo Model
     * @var Userinfo
     */
    protected $userinfoModel;
    
    /**
     * Request
     * @var Request
     */
    protected $request;

    /**
     * 新しいコントローラインスタンスの生成
     * 
     * @param Request $request
     * @param  \App\Models\Userinfo  $userinfo
     * @return void
     */
    public function __construct(Request $request,  Userinfo $userinfo)
    {
        $this->request = $request;
        $this->userinfoModel = $userinfo;
    }

    /**
     * ユーザー情報入力画面
     * 
     */
    public function input()
    {
        // 入力値を取得
        $params['post'] = [
            'last_name' => $this->request->input('last_name', ''),
            'first_name' => $this->request->input('first_name', ''),
            'birthday' => $this->request->input('birthday', ''),
        ];

        return view('user/register/input', $params);
    }

    /**
     * ユーザー情報確認画面
     * 
     */
    public function confirm()
    {
        // 入力値を取得
        $params['post'] = [
            'last_name' => $this->request->input('last_name', ''),
            'first_name' => $this->request->input('first_name', ''),
            'birthday' => $this->request->input('birthday', ''),
        ];

        return view('user/register/confirm', $params);
    }

    /**
     * ユーザー情報確定
     * 
     */
    public function execute()
    {
        // 入力値を取得
        $params['post'] = [
            'last_name' => $this->request->input('last_name', ''),
            'first_name' => $this->request->input('first_name', ''),
            'birthday' => $this->request->input('birthday', ''),
        ];

        // データの新規登録
        $this->userinfoModel->last_name = $this->request->input('last_name', '');
        $this->userinfoModel->first_name = $this->request->input('first_name', '');
        $this->userinfoModel->birthday = $this->request->input('birthday', '');

        $this->userinfoModel->save();

        return redirect()->route('user.register.complete');
    }

    /**
     * ユーザー情報完了画面
     * 
     */
    public function complete()
    {
        return view('user/register/complete');
    }
}
