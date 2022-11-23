<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Userinfo extends Model
{
    use HasFactory;

    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'userinfo';

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    /**
     * ユーザー一覧を取得
     * 
     * @retutn Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        $sub = Examination::select('user_id', DB::raw('count(*) AS cnt'))
                ->whereNull('delete_time')
                ->groupBy('user_id');

        return $this->select('id', 'last_name', 'first_name', DB::raw("TIMESTAMPDIFF(YEAR, birthday, DATE_FORMAT(ADDDATE(CURDATE(), 275), '%Y-03-31')) as age"), 'cnt')
            ->leftJoinSub($sub, 'examination', function ($join) {
                $join->on('userinfo.id', '=', 'examination.user_id');
            })
        ->whereNull('delete_time');

    }

    /**
     * ユーザーIDを条件に受診記録を取得
     * 
     * @param int $userid ユーザーID
     * @retutn Illuminate\Database\Eloquent\Collection
     */
    public function byUserid($userid)
    {
        return $this->select('id', 'last_name', 'first_name', 'birthday', DB::raw("TIMESTAMPDIFF(YEAR, birthday, DATE_FORMAT(ADDDATE(CURDATE(), 275), '%Y-03-31')) as age"))
                    ->whereNull('delete_time')
                    ->where('id', '=', $userid);
    }
}
