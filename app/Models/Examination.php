<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Examination extends Model
{
    use HasFactory;

    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'examination';

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    /**
     * 受診記録を元に年度一覧を取得
     *
     * @retutn Illuminate\Database\Eloquent\Collection
     */
    public function yearList()
    {
        return $this->select('year')
                    ->whereNull('delete_time')
                    ->orderBy('year', 'desc');
    }

    /**
     * 年度を条件に受診記録を取得
     * 
     * @param string $year 年度 
     * @retutn Illuminate\Database\Eloquent\Collection
     */
    public function byYear($year)
    {
        return $this->select('user_id', 'course', 'examination_date', 'place', 'userinfo.last_name', 'userinfo.first_name')
                    ->leftJoin('userinfo', 'examination.user_id', '=', 'userinfo.id')
                    ->whereNull('examination.delete_time')
                    ->where('year', '=', $year);
    }

    /**
     * ユーザーIDを条件に受診記録を取得
     * 
     * @param int $userid ユーザーID
     * @retutn Illuminate\Database\Eloquent\Collection
     */
    public function byUserid($userid)
    {
        return $this->whereNull('delete_time')
                    ->where('user_id', '=', $userid);
    }
}
