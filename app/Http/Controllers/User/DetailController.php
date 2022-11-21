<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DetailController extends BaseController
{

    /**
     * ユーザー詳細画面
     * 
     * @param Request $request
     * @param int $userid ユーザーID
     */
    public function index(Request $request, $userid)
    {
        // 指定されたユーザー情報を1件取得
        $params['userinfo'] = DB::table('userinfo')
                                ->select('id', 'name', 'birthday', DB::raw("TIMESTAMPDIFF(YEAR, birthday, DATE_FORMAT(ADDDATE(CURDATE(), 275), '%Y-03-31')) as age"))
                                ->whereNull('delete_time')
                                ->where('id', '=', $userid)
                                ->first();

        // ユーザーIDを元に受診記録一覧取得
        $params['examinations'] = DB::table('examination')
                                ->select('course', 'examination_date', 'place', DB::raw("DATE_FORMAT(DATE_SUB(examination_date, INTERVAL 3 MONTH),'%Y') AS year"))
                                ->whereNull('delete_time')
                                ->where('user_id', '=', $userid)
                                ->get();

        return view('user/detail', $params);
    }
}
