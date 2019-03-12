<?php

use Illuminate\Database\Seeder;

class SensorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sensors')->delete();
        
        \DB::table('sensors')->insert(array (
            0 => 
            array (
                'id' => 1,
            'name' => '温度1 (℃)',
                'address' => 0,
                'sensunit_id' => 1,
                'project_id' => 3,
                'ctgain' => 0.1,
                'yscalemax' => 0,
                'yscalemin' => 0,
                'ctoffset' => -3.5,
                'limitupper' => 0.0,
                'limitunder' => 0.0,
                'alertmode' => 0,
                'created_at' => '2018-06-15 01:02:23',
                'updated_at' => '2018-12-13 13:21:26',
            ),
            1 => 
            array (
                'id' => 2,
            'name' => '湿度　(%)',
                'address' => 1,
                'sensunit_id' => 1,
                'project_id' => 3,
                'ctgain' => 0.08,
                'yscalemax' => 0,
                'yscalemin' => 0,
                'ctoffset' => 20.0,
                'limitupper' => 0.0,
                'limitunder' => 0.0,
                'alertmode' => 0,
                'created_at' => '2018-06-18 11:34:15',
                'updated_at' => '2018-10-15 12:06:09',
            ),
            2 => 
            array (
                'id' => 4,
            'name' => '照度　(Lux)',
                'address' => 2,
                'sensunit_id' => 1,
                'project_id' => 3,
                'ctgain' => 658.0,
                'yscalemax' => 0,
                'yscalemin' => 0,
                'ctoffset' => 0.0,
                'limitupper' => 0.0,
                'limitunder' => 0.0,
                'alertmode' => 0,
                'created_at' => '2018-07-12 16:13:40',
                'updated_at' => '2018-10-13 11:48:44',
            ),
            3 => 
            array (
                'id' => 5,
            'name' => '二酸化炭素　(ppm)',
                'address' => 3,
                'sensunit_id' => 1,
                'project_id' => 3,
                'ctgain' => 1.0,
                'yscalemax' => 0,
                'yscalemin' => 0,
                'ctoffset' => -25.0,
                'limitupper' => 0.0,
                'limitunder' => 0.0,
                'alertmode' => 0,
                'created_at' => '2018-07-12 16:14:31',
                'updated_at' => '2018-10-04 09:10:31',
            ),
            4 => 
            array (
                'id' => 6,
            'name' => '土壌水分　(%)',
                'address' => 4,
                'sensunit_id' => 1,
                'project_id' => 3,
                'ctgain' => -0.41000000000000003,
                'yscalemax' => 0,
                'yscalemin' => 0,
                'ctoffset' => 235.0,
                'limitupper' => 0.0,
                'limitunder' => 0.0,
                'alertmode' => 0,
                'created_at' => '2018-07-12 16:15:20',
                'updated_at' => '2018-10-13 18:04:39',
            ),
            5 => 
            array (
                'id' => 7,
            'name' => '温度2 (℃)',
                'address' => 0,
                'sensunit_id' => 3,
                'project_id' => 3,
                'ctgain' => 0.1,
                'yscalemax' => 0,
                'yscalemin' => 0,
                'ctoffset' => -3.5,
                'limitupper' => 0.0,
                'limitunder' => 0.0,
                'alertmode' => 0,
                'created_at' => '2018-08-16 18:47:48',
                'updated_at' => '2019-02-11 16:35:56',
            ),
            6 => 
            array (
                'id' => 8,
            'name' => '湿度　(%)',
                'address' => 1,
                'sensunit_id' => 3,
                'project_id' => 3,
                'ctgain' => 0.08,
                'yscalemax' => 0,
                'yscalemin' => 0,
                'ctoffset' => 20.0,
                'limitupper' => 0.0,
                'limitunder' => 0.0,
                'alertmode' => 0,
                'created_at' => '2018-08-16 18:55:32',
                'updated_at' => '2019-02-11 16:36:09',
            ),
            7 => 
            array (
                'id' => 9,
            'name' => '照度　(Lux)',
                'address' => 2,
                'sensunit_id' => 3,
                'project_id' => 3,
                'ctgain' => 658.0,
                'yscalemax' => 0,
                'yscalemin' => 0,
                'ctoffset' => 0.0,
                'limitupper' => 0.0,
                'limitunder' => 0.0,
                'alertmode' => 0,
                'created_at' => '2018-08-29 00:32:30',
                'updated_at' => '2019-02-11 16:52:42',
            ),
            8 => 
            array (
                'id' => 10,
            'name' => '二酸化炭素　(ppm)',
                'address' => 3,
                'sensunit_id' => 3,
                'project_id' => 3,
                'ctgain' => 1.0,
                'yscalemax' => 0,
                'yscalemin' => 0,
                'ctoffset' => 25.0,
                'limitupper' => 0.0,
                'limitunder' => 0.0,
                'alertmode' => 0,
                'created_at' => '2018-08-29 00:33:19',
                'updated_at' => '2019-02-11 16:52:27',
            ),
            9 => 
            array (
                'id' => 11,
            'name' => '土壌水分　(%)',
                'address' => 4,
                'sensunit_id' => 3,
                'project_id' => 3,
                'ctgain' => -0.41000000000000003,
                'yscalemax' => 0,
                'yscalemin' => 0,
                'ctoffset' => 235.0,
                'limitupper' => 0.0,
                'limitunder' => 0.0,
                'alertmode' => 0,
                'created_at' => '2018-08-29 00:33:53',
                'updated_at' => '2019-02-11 16:52:09',
            ),
        ));
        
        
    }
}