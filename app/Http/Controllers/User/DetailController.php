<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Examination;
use App\Models\Userinfo;

class DetailController extends BaseController
{

    /**
     * Examination Model
     * @var Examination
     */
    protected $examinationModel;

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
     * @param  \App\Models\Examination  $examination
     * @param  \App\Models\Userinfo  $userinfo
     * @return void
     */
    public function __construct(Request $request, Examination $examination, Userinfo $userinfo)
    {
        $this->request = $request;
        $this->examinationModel = $examination;
        $this->userinfoModel = $userinfo;
    }

    /**
     * ユーザー詳細画面
     * 
     * @param int $userid ユーザーID
     */
    public function index($userid)
    {
        // 指定されたユーザー情報を1件取得
        $params['userinfo'] = $this->userinfoModel->byUserid($userid)->first();

        // ユーザーIDを元に受診記録一覧取得
        $params['examinations'] = $this->examinationModel->byUserid($userid)->get();

        return view('user/detail', $params);
    }
}
