<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Setting;
use App\Projectatuser;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$projectatuserIds = Projectatuser::select('id')->orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('id')->toArray();
		$settings = Setting::orderBy('id', 'desc')->whereIn('project_id', $projectatuserIds)->paginate(10);
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
		return view('setting.index', compact('settings','projectatusers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
        return view('setting.create',compact('settings','projectatusers'));
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
			'settingGroup' => 'required',
			'settingName' => 'required',
			'settingString' => 'required',
			'settingValue' => 'required|integer',
			'project_id' => 'required|integer',
		]); 
		//バリデーション： エラー 
		if ($validator->fails()) { 
			return redirect()->route('setting.create') ->withInput() ->withErrors($validator); 
		}
		
            $setting->settingGroup = $request->input("settingGroup");
            $setting->settingName = $request->input("settingName");
            $setting->settingString = $request->input("settingString");
            $setting->settingValue = $request->input("settingValue");
			$setting->project_id = $request->input("project_id");
			$setting->save();

		return redirect()->route('setting.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$setting = Setting::findOrFail($id);

		return view('setting.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$setting = Setting::findOrFail($id);
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();

		return view('setting.edit', compact('setting','projectatusers'));
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
		//バリデーション 
		$validator = Validator::make($request->all(), [
			'settingGroup' => 'required',
			'settingName' => 'required',
			'settingString' => 'required',
			'settingValue' => 'required|integer',
			'project_id' => 'required|integer',
		]); 
		//バリデーション： エラー 
		if ($validator->fails()) { 
			return redirect()->route('setting.edit',[$id]) ->withInput() ->withErrors($validator); 
		}
		
		$setting = Setting::findOrFail($id);
		$setting->settingGroup = $request->input("settingGroup");
		$setting->settingName = $request->input("settingName");
		$setting->settingString = $request->input("settingString");
		$setting->settingValue = $request->input("settingValue");
		$setting->project_id = $request->input("project_id");
		$setting->save();
		return redirect()->route('setting.index')->with('message', 'Item created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$setting = Setting::findOrFail($id);
		$setting->delete();
		return redirect()->route('setting.index')->with('message', 'Item created successfully.');
    }
}
