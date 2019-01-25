<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

use App\Sensdata;
use App\Projectatuser;
use App\Setting;
use App\Sensor;
use Illuminate\Support\Facades\Validator;


class StatisticsController extends Controller
{
    //積算気温
    public function index(Request $projectid)
    {
        //$sensdatas = Sensdata::orderBy('id', 'desc')->where('project_id',$projectid )->paginate(10);
        $projectatuserIds = Projectatuser::select('id')->orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('id')->toArray();
        //共有プロジェクトIDを追加
        $mymailaddr = Auth::user()->email;
        $pjids = \DB::table('settings')->select('project_id')->where('settingGroup', 'SHAREPROJECT')->where('settingString', $mymailaddr)->where('settingValue', 1)->get();
        foreach ($pjids as $value) {
                $pjid=$value->project_id;
                $projectatusers2 = Projectatuser::where('id', $pjid)->pluck('id')->toArray();
                //$projectatusers2 = \DB::table('projectatusers')->select('name', 'id')->where('id','=', $pjid)->get();
                $projectatuserIds[] = $projectatusers2[0];
        }
//                var_dump($projectatuserIds);
//                exit;       
        
        //$sensdatas = Sensdata::orderBy('id', 'desc')->whereIn('project_id', $projectatuserIds)->paginate(10);
        $projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();

        //settingsからTMPL_INTEG_ST_DATEを取得してSensdata::integratedtempに当てる、'statistics'に配列で追加
        //$projectid=3;
        $statisticArr = Setting::orderBy('id')->whereIn('project_id', $projectatuserIds)->where('settingGroup',"TMPL_INTEG_ST_DATE")->get();
//                var_dump($statisticArr);
//                echo "<br>";
//                var_dump($projectatuserIds);
//                echo "<br>";
//                var_dump($projectatusers);
//                exit;

        foreach ($statisticArr as $stac) {
            //echo  $stac->settingName;
                //echo  $stac->settingValue;
                //echo  $stac->settingString;
			
			if(strpos($stac->settingString,'|') === false){
				//終了日がない場合
                $statisticsdt[]=Sensdata::integratedtemp($stac->settingString,$stac->settingValue,$stac->settingName,$stac->id,$stac->project_id);
			}else{
				//終了日がある場合パイプで分割
				$dates = explode("|", $stac->settingString);
				$stdt=$dates[0];
				$eddt=$dates[1];
				$statisticsdt[]=Sensdata::integratedtemp($stdt,$stac->settingValue,$stac->settingName,$stac->id,$stac->project_id,$eddt);
			}
				
//$statistics[0]['settingName'] = $stac->settingName;

        }
//	var_dump($statisticsdt);exit;
//exit();		
//		$statistics=Sensdata::integratedtemp("2018-09-15",1);
//var_dump($sensdatas);
//exit();
        return view('statistics.index', compact('statisticsdt','projectatusers'));
    }
    

    public function edit($settingid)
    {
		$setting = Setting::findOrFail($settingid);
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
		$projectatuserIds = Projectatuser::select('id')->orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('id')->toArray();
		$sensors = Sensor::orderBy('id', 'desc')->where('address', 0)->whereIn('project_id', $projectatuserIds)->pluck('name', 'id')->toArray();
        return view('statistics.edit', compact('setting','projectatusers','sensors'));
    }
	
    public function update(Request $request, $id)
    {
		
		//バリデーション 
		$validator = Validator::make($request->all(), [
			'settingGroup' => 'required',
			'settingName' => 'required',
			'settingString' => 'required|date_format:"Y-m-d"',
			'settingString2' => 'nullable|date_format:"Y-m-d"',
			'settingValue' => 'required|integer',
			'project_id' => 'required|integer',
		]); 
		//バリデーション： エラー 
		if ($validator->fails()) { 
			return redirect()->route('statistics.edit',[$id]) ->withInput() ->withErrors($validator); 
		}
		
		$setting = Setting::findOrFail($id);
		$setting->settingGroup = $request->input("settingGroup");
		$setting->settingName = $request->input("settingName");
		if($request->input("settingString2")==""){
			$setting->settingString = $request->input("settingString");
		}else{
			$setting->settingString = $request->input("settingString")."|". $request->input("settingString2");
		}
		$setting->settingValue = $request->input("settingValue");
		$setting->project_id = $request->input("project_id");
		$setting->save();
		return redirect()->route('statistics.index')->with('message', 'update successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
		$projectatuserIds = Projectatuser::select('id')->orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('id')->toArray();
		$sensors = Sensor::orderBy('id', 'desc')->where('address', 0)->whereIn('project_id', $projectatuserIds)->pluck('name', 'id')->toArray();
        return view('statistics.create',compact('settings','projectatusers','sensors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$setting = new Setting();
		
		
		//バリデーション 
		$validator = Validator::make($request->all(), [
			'settingName' => 'required',
			'settingString' => 'required|date_format:"Y-m-d"',
			'settingString2' => 'nullable|date_format:"Y-m-d"',
			'settingValue' => 'required|integer',
			'project_id' => 'required|integer',
		]); 
		//バリデーション： エラー 
		if ($validator->fails()) { 
			return redirect()->route('statistics.create') ->withInput() ->withErrors($validator); 

		}
		
            $setting->settingGroup = $request->input("settingGroup");
            $setting->settingName = $request->input("settingName");
			if($request->input("settingString2")==""){
				$setting->settingString = $request->input("settingString");
			}else{
				$setting->settingString = $request->input("settingString")."|". $request->input("settingString2");
			}
            $setting->settingValue = $request->input("settingValue");
			$setting->project_id = $request->input("project_id");
			$setting->save();

		return redirect()->route('statistics.index')->with('message', 'Item created successfully.');
    }   
	
    public function destroy($id)
    {
		$setting = Setting::findOrFail($id);
		$setting->delete();
		return redirect()->route('statistics.index')->with('message', 'Item delete successfully.');
    }
    
}
