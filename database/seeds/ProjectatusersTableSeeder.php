<?php

use Illuminate\Database\Seeder;

class ProjectatusersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('projectatusers')->delete();
        
        \DB::table('projectatusers')->insert(array (
            0 => 
            array (
                'id' => 3,
            'name' => 'テスト農園プロジェクト(共有)',
                'user_id' => 1,
                'created_at' => '2018-06-08 10:13:11',
                'updated_at' => '2018-09-23 10:19:43',
            ),
            1 => 
            array (
                'id' => 6,
            'name' => 'プロジェクト２(共有)',
                'user_id' => 1,
                'created_at' => '2018-06-11 10:45:47',
                'updated_at' => '2018-09-27 16:19:22',
            ),
            2 => 
            array (
                'id' => 11,
                'name' => 'test',
                'user_id' => 2,
                'created_at' => '2018-12-13 13:00:33',
                'updated_at' => '2018-12-13 13:00:33',
            ),
        ));
        
        
    }
}