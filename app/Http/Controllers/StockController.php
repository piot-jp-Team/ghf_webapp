<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Stock;
use Illuminate\Support\Facades\Auth;
use App\Projectatuser;
use App\Sensor;
use App\Setting;
use Illuminate\Support\Facades\Validator;


class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $projectid,$fromdate="",$todate="")
    {
        //
        $projectid=0;
        $projectatusers = Projectatuser::orderBy('id')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
		//共有プロジェクトIDを追加
		$mymailaddr = Auth::user()->email;
		$pjids = \DB::table('settings')->select('project_id')->where('settingGroup', 'SHAREPROJECT')->where('settingString', $mymailaddr)->where('settingValue', 1)->get();
		foreach ($pjids as $value) {
			$pjid=$value->project_id;
			$projectatusers2 = Projectatuser::where('id', $pjid)->pluck('name', 'id')->toArray();
			//$projectatusers2 = \DB::table('projectatusers')->select('name', 'id')->where('id', $pjid)->get();
			$projectatusers = $projectatusers+$projectatusers2;
		}
        $sensors = \DB::table('sensors')->select('id')->orderBy('id')->where('project_id','=', $projectid)->get();
        //echo($sensors);exit();
		$timespan = 0;
		return view('index',compact('projectatusers', 'sensors', 'projectid', 'timespan'));
    }
	
    //public function changeprj(Request $projectid,$fromdate="",$todate="")	
    public function changeprj(Request $prjid)
    {
		//バリデーション 
		$validator = Validator::make($prjid->all(), [
			'projectid' => 'required|integer',
		]); 
		//バリデーション： エラー 
		if ($validator->fails()) { 
			return redirect('/') ->withInput() ->withErrors($validator); 

		}
		$projectid = $prjid->projectid;
		$timespan = $prjid->timespan;
		
		$projectatusers = Projectatuser::orderBy('id')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
		//共有プロジェクトIDを追加
		$mymailaddr = Auth::user()->email;
		$pjids = \DB::table('settings')->select('project_id')->where('settingGroup', 'SHAREPROJECT')->where('settingString', $mymailaddr)->where('settingValue', 1)->get();
		foreach ($pjids as $value) {
			$pjid=$value->project_id;
			$projectatusers2 = Projectatuser::where('id', $pjid)->pluck('name', 'id')->toArray();
			//$projectatusers2 = \DB::table('projectatusers')->select('name', 'id')->where('id','=', $pjid)->get();
			$projectatusers = $projectatusers+$projectatusers2;
		}
		$sensors = \DB::table('sensors')->orderBy('address')->orderBy('id')->where('project_id','=', $projectid)->get();
		//echo($sensors);exit();
		return view('index',compact('projectatusers', 'sensors', 'projectid', 'timespan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	return view('Stock');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $stock = new Stock([
          'stockName' => $request->get('stockName'),
          'stockPrice' => $request->get('stockPrice'),
          'stockYear' => $request->get('stockYear'),
        ]);
        $stock->save();

        return redirect('stocks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
  /**
     * Fetch the particular company details
     * @return json response
     */
      public function chart($sensorid)
      {
        $result = \DB::table('sensdatas')
                    ->join('sensors', 'sensors.id', '=', 'sensdatas.sensoer_id')
                    ->join('sensunits', 'sensunits.id', '=', 'sensors.sensunit_id')
                    ->join('shieldmodules', 'sensunits.shield_id', '=', 'shieldmodules.id')
                    ->join('projectatusers', 'sensors.project_id', '=', 'projectatusers.id')
                    //->select(\DB::raw('projectatusers.name as pjname,shieldmodules.name as shieldname,sensunits.name as unitname,sensors.name as name, date_format(DATE_ADD(sensdatas.sddatetime, INTERVAL 9 HOUR),\'%Y-%m-%dT%TZ\') as sddatetime, sddvalue'))
                    ->select(\DB::raw('projectatusers.name as pjname,shieldmodules.name as shieldname,sensunits.name as unitname,sensors.name as name, date_format(sensdatas.sddatetime,\'%Y-%m-%dT%TZ\') as sddatetime, sddvalue'))
                    ->where('sensoer_id','=',$sensorid)
                    ->where('sddatetime','>',date('Y-m-d H-i-s' , strtotime('-1 day')))
                    ->orderBy('sddatetime', 'ASC')
                    ->get();
        return response()->json($result);
      }


      public function chart2($sensorid,$from="2018-07-14",$to="2018-07-15")
      {
        //JST 9時間引く  selectは　逆に足す
        $from = date("Y-m-d H:i:s",strtotime($from." 0:00:00"));
        $to = date("Y-m-d H:i:s",strtotime($to." 0:00:00"." +24 hour"));
        $result = \DB::table('sensdatas')
                    ->join('sensors', 'sensors.id', '=', 'sensdatas.sensoer_id')
                    ->join('sensunits', 'sensunits.id', '=', 'sensors.sensunit_id')
                    ->join('shieldmodules', 'sensunits.shield_id', '=', 'shieldmodules.id')
                    ->join('projectatusers', 'sensors.project_id', '=', 'projectatusers.id')
                    //->select(\DB::raw('projectatusers.name as pjname,shieldmodules.name as shieldname,sensunits.name as unitname,sensors.name as name, date_format(DATE_ADD(sensdatas.sddatetime, INTERVAL 9 HOUR),\'%Y-%m-%dT%TZ\') as sddatetime, sddvalue'))
                    ->select(\DB::raw('projectatusers.name as pjname,shieldmodules.name as shieldname,sensunits.name as unitname,sensors.name as name, date_format(sensdatas.sddatetime,\'%Y-%m-%dT%TZ\') as sddatetime, sddvalue'))
                    ->where('sensoer_id','=',$sensorid)
                    //->where(\DB::raw('sddatetime>=DATE_ADD('."'".$from." 0:00:00'".', INTERVAL -9 HOUR)'))
                    //->where(\DB::raw('sddatetime<=DATE_ADD('."'".$to." 23:59:59'".', INTERVAL -9 HOUR)'))
                    ->where('sddatetime','>=',$from)
                    ->where('sddatetime','<=',$to)   
                    ->orderBy('sddatetime', 'ASC')
                    ->get();

        return response()->json($result);
      }

      public function housa($sensorid1=1,$sensorid2=2)
      {
		$from=date('Y-m-d H-i-s' , strtotime('-1 day'));
		$to=date('Y-m-d H-i-s');
		$result = \DB::select("select projectatusers.name as pjname,shieldmodules.name as shieldname,sensunits.name as unitname,'飽差 g/m3' as name, 
date_format(dst1.sddatetime,'%Y-%m-%dT%TZ') as sddatetime,data1,data2 from 
(select sddatetime,ds1.sddvalue as data1,sensoer_id from sensdatas as ds1 where sddatetime>=? and sddatetime<=? and sensoer_id = ?) as dst1 
inner join 
(select sddatetime,ds2.sddvalue as data2 from sensdatas as ds2 where sddatetime>=? and sddatetime<=? and sensoer_id = ?) as dst2 on dst1.sddatetime = dst2.sddatetime 
                    inner join sensors on sensors.id=dst1.sensoer_id
                    inner join sensunits on sensunits.id = sensors.sensunit_id
                    inner join shieldmodules on sensunits.shield_id = shieldmodules.id
                    inner join projectatusers on sensors.project_id = projectatusers.id",[$from,$to,$sensorid1,$from,$to,$sensorid2]);
		$result1=array();
		$result2=array();
		$housa=0.01;
		$houwasuijoukiatsu=0.01;
		$houwasuijoukiryou=0.01;
		foreach($result as $row){
			$houwasuijoukiatsu=6.1087*pow(10,(7.5*$row->data1/($row->data1+237.3)));
			$houwasuijoukiryou=217*$houwasuijoukiatsu/($row->data1+273.15);
			$housa=(100-$row->data2)*$houwasuijoukiryou/100;
			$row->data3=round($housa,2);
			$result1['pjname']=$row->pjname;
			$result1['shieldname']=$row->shieldname;
			$result1['unitname']=$row->unitname;
			$result1['name']=$row->name;
			$result1['sddatetime']=$row->sddatetime;
			$result1['data1']=$row->data1;
			$result1['data2']=$row->data2;
			$result1['sddvalue']=$row->data3;
			$result2[]=$result1;
		}
		return response()->json($result2);
      }


}
