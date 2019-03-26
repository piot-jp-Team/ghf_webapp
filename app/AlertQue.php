<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertQue extends Model
{
    protected $table = 'alertques';
    /**
     * センサーテーブルとのリレーションを定義しています。
     *
     * @return void
     */
    public function Sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}
