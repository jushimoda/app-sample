<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Userinfo;

class ListController extends BaseController
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
    public function __construct(Request $request, Userinfo $userinfo)
    {
        $this->request = $request;
        $this->userinfoModel = $userinfo;
    }

    /**
     * ユーザー一覧画面
     * 
     */
    public function index()
    {   
        // ユーザー情報一覧を取得
        $params['userinfos'] = $this->userinfoModel->list()->get();

        return view('user/list', $params);
    }
}
