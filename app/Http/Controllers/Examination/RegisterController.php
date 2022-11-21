<?php

namespace App\Http\Controllers\Examination;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{
    /**
     * 受診記録登録入力画面
     * 
     * @param Request $request
     */
    public function input(Request $request, $userid)
    {
        // 入力値を取得
        $params['post'] = [
            'examination_date' => $request->input('examination_date', ''),
            'course' => $request->input('course', ''),
            'place' => $request->input('place', ''),
            'userid' => $userid,
        ];

        return view('examination/register/input', $params);
    }

    /**
     * 受診記録登録確認画面
     * 
     * @param Request $request
     */
    public function confirm(Request $request, $userid)
    {
        // 入力値を取得
        $params['post'] = [
            'examination_date' => $request->input('examination_date', ''),
            'course' => $request->input('course', ''),
            'place' => $request->input('place', ''),
            'userid' => $userid,
        ];

        return view('examination/register/confirm', $params);
    }

    /**
     * 受診記録登録確定
     * 
     * @param Request $request
     */
    public function execute(Request $request, $userid)
    {
        // 入力値を取得
        $params['post'] = [
            'examination_date' => $request->input('examination_date', ''),
            'course' => $request->input('course', ''),
            'place' => $request->input('place', ''),
            'userid' => $userid,
        ];

        // 現在日時の取得
        $now = (new \DateTime())->format('Y-m-d H:i:s');

        DB::table('examination')->insert([
            'user_id' => $userid,
            'course' => $request->input('course', ''),
            'examination_date' => $request->input('examination_date', ''),
            'place' => $request->input('place', ''),
            'update_time' => $now,
            'create_time' => $now,
        ]);

        return redirect()->route('examination.register.complete');
    }

    /**
     * 受診記録登録完了画面
     * 
     * @param Request $request
     */
    public function complete(Request $request)
    {
        return view('examination/register/complete');
    }
}
