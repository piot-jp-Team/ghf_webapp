<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    public function sensunit() {
        return $this->belongsTo(Sensunit::class);
    }
    public function sensdata()
    {
        return $this->hasMany(Sensdata::class);
    }
	public function projectatuser() {
        return $this->belongsTo(Projectatuser::class,'project_id');
    }
}
