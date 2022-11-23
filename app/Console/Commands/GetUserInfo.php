<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Examination;
use App\Models\Userinfo;

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
     * @param  \App\Models\Examination  $examination
     * @param  \App\Models\Userinfo  $userinfo
     * @return int
     */
    public function handle(Examination $examination, Userinfo $userinfo)
    {
        $userid = $this->argument('userid');

        // 指定されたユーザー情報を1件取得
        $data = $userinfo->byUserid($userid)->first();
        
        // 受診コースを判別
        $course = ($data->age >= 35) ? '1日人間ドック' : '基本健診';

        // ユーザー情報出力
        print '【ユーザー情報】'.PHP_EOL;
        print 'ユーザーID:'.$data->id.PHP_EOL;
        print '名前:'.$data->last_name.' '.$data->first_name.PHP_EOL;
        print '生年月日:'.$data->birthday.PHP_EOL;
        print '年度年齢:'.$data->age.PHP_EOL;
        print '今年度の受診コース:'.$course.PHP_EOL;

        // ユーザーIDを元に受診記録一覧取得
        $data = $examination->byUserid($userid)->get();

        // 受診記録一覧出力
        print '【受診記録一覧】'.PHP_EOL;
        print '|受診年度|受診日|受診コース|受診場所|'.PHP_EOL;
        foreach($data as $examination){
            print '|';
            print $examination->year.'|';
            print $examination->examination_date.'|';
            if($examination->course === 1){
                print '1日人間ドック|';
            } elseif($examination->course === 2){
                print '基本検診|';
            }
            print $examination->place.'|';
            print PHP_EOL;
        }

        return Command::SUCCESS;
    }
}
