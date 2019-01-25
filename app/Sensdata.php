<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Sensdata extends Model
{
    public function sensor() {
        return $this->belongsTo(Sensor::class);
    }
	public function projectatuser() {
        return $this->belongsTo(Projectatuser::class,'project_id');
    }
	
	public static function integratedtemp($start_date="2018-09-15",$sensid=0,$settingName="",$settingid,$project_id,$end_date="") {	
		$sql="select '".$project_id."' as project_id, '".$settingid."' as settingid, '".$settingName."' as name, min(agvtbl.sddate) as start_date , max(agvtbl.sddate) as end_date, round(sum(agvtbl.avgdate),0) as integrate_temp from (select sddate,avg(sddvalue) as avgdate from sensdatas where sensoer_id=".$sensid." and sddate >= '".$start_date."'";
		if($end_date!=""){
			$sql.=" and sddate <= '".$end_date."' ";
		}
		$sql.=" group by sddate) as agvtbl;";
        return DB::select($sql);
    }
	
}
