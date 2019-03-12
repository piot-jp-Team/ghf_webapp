<?php

use Illuminate\Database\Seeder;

class AlertquesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('alertques')->delete();
        
        \DB::table('alertques')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sensdata_id' => 421538,
                'sensor_id' => 1,
                'sddvalue' => 9.9,
                'limitupper' => 30.0,
                'limitunder' => 10.0,
                'sendflg' => 1,
                'project_id' => 3,
                'sendingtime' => '2019-03-12 01:50:01',
                'created_at' => '2019-03-12 01:49:58',
                'updated_at' => '2019-03-12 01:49:58',
            ),
            1 => 
            array (
                'id' => 2,
                'sensdata_id' => 421543,
                'sensor_id' => 1,
                'sddvalue' => 9.85,
                'limitupper' => 30.0,
                'limitunder' => 10.0,
                'sendflg' => 2,
                'project_id' => 3,
                'sendingtime' => '2019-03-12 01:56:01',
                'created_at' => '2019-03-12 01:56:58',
                'updated_at' => '2019-03-12 01:56:58',
            ),
            2 => 
            array (
                'id' => 3,
                'sensdata_id' => 421548,
                'sensor_id' => 1,
                'sddvalue' => 9.8,
                'limitupper' => 30.0,
                'limitunder' => 10.0,
                'sendflg' => 1,
                'project_id' => 3,
                'sendingtime' => '2019-03-12 02:03:01',
                'created_at' => '2019-03-12 02:02:58',
                'updated_at' => '2019-03-12 02:02:58',
            ),
            3 => 
            array (
                'id' => 4,
                'sensdata_id' => 421553,
                'sensor_id' => 1,
                'sddvalue' => 9.6,
                'limitupper' => 30.0,
                'limitunder' => 10.0,
                'sendflg' => 2,
                'project_id' => 3,
                'sendingtime' => '2019-03-12 02:09:01',
                'created_at' => '2019-03-12 02:08:58',
                'updated_at' => '2019-03-12 02:08:58',
            ),
        ));
        
        
    }
}