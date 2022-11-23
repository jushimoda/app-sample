<?php

namespace App\Http\Controllers\Examination;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Examination;

class RegisterController extends BaseController
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
     * @param \App\Models\Examination  $examination
     * @return void
     */
    public function __construct(Request $request, Examination $examination)
    {
        $this->request = $request;
        $this->examinationModel = $examination;

    }

    /**
     * 受診記録登録入力画面
     * 
     * @param string $userid 受診記録を登録するユーザーID
     */
    public function input($userid)
    {
        // 入力値を取得
        $params['post'] = [
            'examination_date' => $this->request->input('examination_date', ''),
            'course' => $this->request->input('course', ''),
            'place' => $this->request->input('place', ''),
            'userid' => $userid,
        ];

        return view('examination/register/input', $params);
    }

    /**
     * 受診記録登録確認画面
     * 
     * @param string $userid 受診記録を登録するユーザーID
     */
    public function confirm($userid)
    {
        // 入力値を取得
        $params['post'] = [
            'examination_date' => $this->request->input('examination_date', ''),
            'course' => $this->request->input('course', ''),
            'place' => $this->request->input('place', ''),
            'userid' => $userid,
        ];

        return view('examination/register/confirm', $params);
    }

    /**
     * 受診記録登録確定
     * 
     * @param string $userid 受診記録を登録するユーザーID
     */
    public function execute($userid)
    {
        // 年度の取得
        $year = (new \DateTime($this->request->input('examination_date')))->modify('-3 month')->format('Y');

        // データの新規登録
        $this->examinationModel->user_id = $userid;
        $this->examinationModel->course = $this->request->input('course');
        $this->examinationModel->year = $year;
        $this->examinationModel->examination_date = $this->request->input('examination_date');
        $this->examinationModel->place = $this->request->input('place');

        $this->examinationModel->save();

        return redirect()->route('examination.register.complete');
    }

    /**
     * 受診記録登録完了画面
     */
    public function complete()
    {
        return view('examination/register/complete');
    }
}
