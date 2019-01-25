<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Sensdata;
use App\Projectatuser;

class SensdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//$sensdatas = Sensdata::orderBy('id', 'desc')->where('project_id',$projectid )->paginate(10);
		$projectatuserIds = Projectatuser::select('id')->orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('id')->toArray();
		$sensdatas = Sensdata::orderBy('id', 'desc')->whereIn('project_id', $projectatuserIds)->paginate(10);
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
//var_dump($sensdatas);
//exit();
		return view('sensdata.index', compact('sensdatas','projectatusers'));
    }
	
    public function onesenserdata($snsid)
    {
		//$sensdatas = Sensdata::orderBy('id', 'desc')->where('project_id',$projectid )->paginate(10);
		$projectatuserIds = Projectatuser::select('id')->orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('id')->toArray();
		$sensdatas = Sensdata::orderBy('id', 'desc')->whereIn('project_id', $projectatuserIds)->where('sensoer_id', $snsid)->paginate(10);
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
		return view('sensdata.index', compact('sensdatas','projectatusers'));
    }

	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
        return view('sensdata.create', compact('projectatusers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$sensdata = new Sensdata();
            $sensdata->sensoer_id = $request->input("sensoer_id");
            $sensdata->sddate = $request->input("sddate");
            $sensdata->sdtime = $request->input("sdtime");
            $sensdata->sddatetime = $request->input("sddatetime");
            $sensdata->sddvalue = $request->input("sddvalue");
            $sensdata->sdivalue = $request->input("sdivalue");
            $sensdata->sdflug = $request->input("sdflug");
			$sensdata->project_id = $request->input("project_id");
			$sensdata->save();

		return redirect()->route('sensdata.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$sensdata = Sensdata::findOrFail($id);
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
		return view('sensdata.show', compact('sensdata','projectatusers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$sensdata = Sensdata::findOrFail($id);
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
		return view('sensdata.edit', compact('sensdata','projectatusers'));
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
		$sensdata = Sensdata::findOrFail($id);
        $sensdata->sensoer_id = $request->input("sensoer_id");
        $sensdata->sddate = $request->input("sddate");
        $sensdata->sdtime = $request->input("sdtime");
        $sensdata->sddatetime = $request->input("sddatetime");
        $sensdata->sddvalue = $request->input("sddvalue");
        $sensdata->sdivalue = $request->input("sdivalue");
        $sensdata->sdflug = $request->input("sdflug");
		$sensdata->project_id = $request->input("project_id");
		$sensdata->save();
		return redirect()->route('sensdata.index')->with('message', 'Item created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$sensdata = Sensdata::findOrFail($id);
		$sensdata->delete();
		return redirect()->route('sensdata.index')->with('message', 'Item created successfully.');
    }
}
