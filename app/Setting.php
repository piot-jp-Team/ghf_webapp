<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable = ['settingGroup', 'settingName', 'settingString', 'settingValue'];
	
	public function projectatuser() {
        return $this->belongsTo(Projectatuser::class,'project_id');
    }
	
}
