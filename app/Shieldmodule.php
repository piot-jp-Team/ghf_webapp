<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;

class Shieldmodule extends Model
{
    public function sensunit()
    {
        return $this->hasMany(Sensunit::class);
    }
	public function projectatuser() 
	{
        return $this->belongsTo(Projectatuser::class,'project_id');
    }
}
