<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensunit extends Model
{
    public function shieldmodule() {
        return $this->belongsTo(Shieldmodule::class,'shield_id');
    }
    public function sensor()
    {
        return $this->hasMany(Sensor::class);
    }
	public function projectatuser() {
        return $this->belongsTo(Projectatuser::class,'project_id');
    }
}
