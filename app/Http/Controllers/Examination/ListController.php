<?php

namespace App\Http\Controllers\Examination;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ListController extends BaseController
{
    /**
     * 受診記録一覧画面
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        // 年度が指定されていなければ今年度のデータが対象
        $year = $request->input('year', (new \DateTime('-3 month'))->format('Y'));

        $params['targetyear'] = $year;

        // 年度のリストを取得
        $params['yearlist'] = DB::table('examination')
                                ->select(DB::raw("DISTINCT DATE_FORMAT(DATE_SUB(examination_date, INTERVAL 3 MONTH),'%Y') AS year"))
                                ->whereNull('delete_time')
                                ->orderBy('year', 'desc')
                                ->get();

        // 年度を元に受診記録一覧取得
        $params['examinations'] = DB::table('examination')
                            ->select('user_id', 'course', 'examination_date', 'place', 'userinfo.name')
                            ->leftJoin('userinfo', 'examination.user_id', '=', 'userinfo.id')
                            ->whereNull('examination.delete_time')
                            ->where(DB::raw("DATE_FORMAT(DATE_SUB(examination.examination_date, INTERVAL 3 MONTH),'%Y')"), '=', $year)
                            ->get();

        return view('examination/list', $params);
    }
}
