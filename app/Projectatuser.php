<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectatuser extends Model
{
	public function user() {
        return $this->belongsTo(User::class);
    }
    public function sensdata()
    {
        return $this->hasMany(Sensdata::class,'project_id');
    }
    public function sensor()
    {
        return $this->hasMany(Sensor::class,'project_id');
    }
    public function sensunit()
    {
        return $this->hasMany(Sensunit::class,'project_id');
    }
    public function shieldmodule()
    {
        return $this->hasMany(Shieldmodule::class,'project_id');
    }
    public function setting()
    {
        return $this->hasMany(Setting::class,'project_id');
    }
}
