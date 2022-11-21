<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GetUserInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show:userinfo {userid}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ユーザー情報取得';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userid = $this->argument('userid');

        // 指定されたユーザー情報を1件取得
        $data = DB::table('userinfo')
                    ->select('id', 'name', 'birthday', DB::raw("TIMESTAMPDIFF(YEAR, birthday, DATE_FORMAT(ADDDATE(CURDATE(), 275), '%Y-03-31')) as age"))
                    ->whereNull('delete_time')
                    ->where('id', '=', $userid)
                    ->first();

        // 受診コースを判別
        $course = ($data->age >= 35) ? '1日人間ドック' : '基本健診';

        // ユーザー情報出力
        print '【ユーザー情報】'.PHP_EOL;
        print 'ユーザーID:'.$data->id.PHP_EOL;
        print '名前:'.$data->name.PHP_EOL;
        print '生年月日:'.$data->birthday.PHP_EOL;
        print '年度年齢:'.$data->age.PHP_EOL;
        print '今年度の受診コース:'.$course.PHP_EOL;

        // ユーザーIDを元に受診記録一覧取得
        $data = DB::table('examination')
                    ->select('course', 'examination_date', 'place', DB::raw("DATE_FORMAT(DATE_SUB(examination_date, INTERVAL 3 MONTH),'%Y') AS year"))
                    ->whereNull('delete_time')
                    ->where('user_id', '=', $userid)
                    ->get();

        // 受診記録一覧出力
        print '【受診記録一覧】'.PHP_EOL;
        print '|受診年度|受診日|受診コース|受診場所|'.PHP_EOL;
        foreach($data as $examination){
            print '|';
            print $examination->year.'|';
            print $examination->examination_date.'|';
            print $examination->course.'|';
            print $examination->place.'|';
            print PHP_EOL;
        }

        return Command::SUCCESS;
    }
}
