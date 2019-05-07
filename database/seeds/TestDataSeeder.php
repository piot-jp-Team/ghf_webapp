<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB 内のテーブルの全てのレコードを削除し、id も 0クリアさせる。
        DB::table('users')->truncate();
        DB::table('projectatusers')->truncate();
        DB::table('shieldmodules')->truncate();
        DB::table('sensunits')->truncate();
        DB::table('sensors')->truncate();
        DB::table('sensdatas')->truncate();
        DB::table('settings')->truncate();

        //test user の追加
        echo '.making test_user' . PHP_EOL;
        $add_user = [
            'name' => 'test_user',
            'email' => 'test_user@test.com',
            'password' => bcrypt('test_user'),
            'verified' => 1,
            'created_at' => '2019-01-01 12:34:57',
            'updated_at' => '2018-06-10 12:34:57',
        ];
        DB::table('users')->insert($add_user);
        $user = DB::table('users')->where('name', 'test_user')->first();
        $user_id = $user->id;
        
        //project at users の追加
        echo '.making test project at users' . PHP_EOL;
        $add_project = [
            'name' => 'テストプロジェクト',
            'user_id' => $user_id,
            'created_at' => '2019-01-01 12:34:57',
            'updated_at' => '2018-06-10 12:34:57',
        ];
        DB::table('projectatusers')->insert($add_project);
        $project_at_user = DB::table('projectatusers')->where('name', 'テストプロジェクト')->first();
        $projectatusres_id = $project_at_user->id;
        
        //shieldmodules の追加
        echo '.making test shield modules' . PHP_EOL;
        $add_module = [
            'name' => 'テストモジュール X 号機',
            'module_id' => 'u0123456789A',
            'project_id' => $projectatusres_id,
            'created_at' => '2019-01-01 12:34:57',
            'updated_at' => '2018-06-10 12:34:57',
        ];
        DB::table('shieldmodules')->insert($add_module);
        $shieldmodule = DB::table('shieldmodules')->where('name', 'テストモジュール X 号機')->first();
        $shieldmodule_id = $shieldmodule->id;
        
        //sense unit の追加
        echo '.making test sense units' . PHP_EOL;
        $add_sense_unit = [
            'name' => 'テストセンサーユニット X 号機',
            'channel' => 1,
            'shield_id' => $shieldmodule_id,
            'project_id' => $projectatusres_id,
            'created_at' => '2019-01-01 12:34:57',
            'updated_at' => '2018-06-10 12:34:57',
        ];
        DB::table('sensunits')->insert($add_sense_unit);
        $sense_unit = DB::table('sensunits')->where('name', 'テストセンサーユニット X 号機')->first();
        $senseunit_id = $sense_unit->id;
        
        //sensors の追加
        echo '.making test sensors' . PHP_EOL;
        $add_sensor = [
            'name' => '温度',
            'address' => 0,
            'sensunit_id' => $senseunit_id,
            'project_id' => $projectatusres_id,
            'ctgain' => 0.1,
            'yscalemax' => 100,
            'yscalemin' => -100,
            'ctoffset' => 0.00,
            'limitupper' => 0.00,
            'limitunder' => 0.00,
            'alertmode' => 0,
            'created_at' => '2019-01-01 12:34:57',
            'updated_at' => '2018-06-10 12:34:57',
        ];
        DB::table('sensors')->insert($add_sensor);
        $sensor = DB::table('sensors')->where('name', '温度')->where('sensunit_id',$senseunit_id)->first();
        $sensor_id = $sensor->id;
        
        //sensdatas の追加
        echo '.making test sense data';
        $caldatetime = strtotime( "-1 year 00:00:00" ); //1年前 の0時0分0秒
        $str_caldatetime = date('Y-m-d H:i:s', $caldatetime);
        $enddatetime = strtotime("+1 year " . $str_caldatetime);
        $tmp_data = -400;  //-40度
        $tmp_ctgain = $sensor->ctgain;
        $tmp_ctoffset = $sensor->ctoffset;
        $updownflug = 'up';
        $loopcounter = 0;
        while($caldatetime <= $enddatetime){
            if($updownflug == 'up'){
                $tmp_data = $tmp_data + 3;
                if($tmp_data >= 850){
                    $updownflug = 'down';
                }
            } else {
                $tmp_data = $tmp_data - 3;
                if($tmp_data <= -400){
                    $updownflug = 'up';
                }
            }
            $sensedata = [
                'sensoer_id' => $sensor_id,
                'sddate' => date('Y-m-d', $caldatetime),
                'sdtime' => date('H:i:s', $caldatetime),
                'sddatetime' => date('Y-m-d H:i:s', $caldatetime),
                'sddvalue' => $tmp_data * $tmp_ctgain + $tmp_ctoffset,
                'sdivalue' => $tmp_data,
                'ctgain' => $tmp_ctgain,
                'ctoffset' => $tmp_ctoffset,
                'sdflug' => '0',
                'project_id' => $projectatusres_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            //echo 'caldatetime=' . date('Y-m-d H:i:s', $caldatetime) . ', sddvalue=' . $sensedata['sddvalue'] . PHP_EOL;
            $str_caldatetime = date('Y-m-d H:i:s', $caldatetime);
            $caldatetime = strtotime("+1 hour " . $str_caldatetime);
            DB::table('sensdatas')->insert($sensedata);
            $loopcounter++;
            if($loopcounter>1000){
                echo '.';
                $loopcounter = 0;
            }
        }
        echo PHP_EOL;
        
        //統計情報 settings の追加
        echo '.making test statics setting' . PHP_EOL;
        $start_datetime = strtotime( "-1 month 00:00:00" ); //1月前の0時0分0秒
        $end_datetime = strtotime( "today" ); //今日の0時0分0秒
        $tmp_settingString = date('Y-m-d', $start_datetime) . '|' . date('Y-m-d', $end_datetime);
        $add_setting = [
            'settingGroup' => 'TMPL_INTEG_ST_DATE',
            'settingName' => 'テストプロジェクト温度統計',
            'settingString' => $tmp_settingString,
            'settingValue' => $sensor_id,
            'project_id' => $projectatusres_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('settings')->insert($add_setting);
        $setting = DB::table('settings')->where('settingName', 'テストプロジェクト温度統計')->first();
        $setting_id = $setting->id;
    }
}
