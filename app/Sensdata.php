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
	
	public static function alertqueinject() {	
		$sql="insert into alertques ("
		. "sensdata_id,sensor_id,sddvalue,limitupper,limitunder,sendflg,project_id,sendingtime,created_at,updated_at"
		. ") select "
		. "sd.id,ss.id,sddvalue,limitupper,limitunder,0,sd.project_id,sd.created_at,now(),now() "
		. "from sensdatas sd left join sensors ss on ss.id=sd.sensoer_id where "
		. "sd.created_at > NOW() - INTERVAL 30 minute "
		. "and ss.alertmode=1 and limitupper<>limitunder and limitupper>limitunder "
		. "and (sddvalue > limitupper or sddvalue < limitunder) "
		. "and sd.id > (select ifnull(max(sensdata_id),0) from alertques);";
        return DB::insert($sql);
    }
	
}
