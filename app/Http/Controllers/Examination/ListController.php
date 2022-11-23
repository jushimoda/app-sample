<?php

namespace App\Http\Controllers\Examination;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Examination;

class ListController extends BaseController
{
    /**
     * Examination Model
     * @var Examination
     */
    protected $examinationModel;

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
     * @return void
     */
    public function __construct(Request $request, Examination $examination)
    {
        $this->request = $request;
        $this->examinationModel = $examination;
    }

    /**
     * 受診記録一覧画面
     */
    public function index()
    {
        // 年度が指定されていなければ今年度のデータが対象
        $year = $this->request->input('year', (new \DateTime('-3 month'))->format('Y'));

        // 年度一覧を取得
        $params['yearlist'] = $this->examinationModel->yearList()->get()->toArray();

        // 対象年度をアサイン
        $params['targetyear'] = $year;

        // 年度のリストを取得
        $params['yearlist'] = $this->examinationModel->yearList()->get();

        // 年度を元に受診記録一覧取得
        $params['examinations'] = $this->examinationModel->byYear($year)->get();

        return view('examination/list', $params);
    }
}
