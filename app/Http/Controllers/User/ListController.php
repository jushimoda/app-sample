<?php

namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ListController extends BaseController
{
    /**
     * ユーザー一覧画面
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $subexamination = DB::table('examination')
                            ->select('user_id', DB::raw('count(*) AS cnt'))
                            ->whereNull('delete_time')
                            ->groupBy('user_id');

        // ユーザー情報一覧を取得
        $params['userinfos'] = DB::table('userinfo')
                                ->select('id', 'name', DB::raw("TIMESTAMPDIFF(YEAR, birthday, DATE_FORMAT(ADDDATE(CURDATE(), 275), '%Y-03-31')) as age"), 'cnt')
                                ->leftJoinSub($subexamination, 'examination', function ($join) {
                                    $join->on('userinfo.id', '=', 'examination.user_id');
                                })
                                ->whereNull('delete_time')
                                ->get();

        return view('user/list', $params);
    }
}
