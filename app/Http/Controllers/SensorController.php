<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Sensor;
use App\Projectatuser;
use App\Sensunit;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$projectatuserIds = Projectatuser::select('id')->orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('id')->toArray();
		$sensors = Sensor::orderBy('id', 'desc')->whereIn('project_id', $projectatuserIds)->paginate(10);
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
//var_dump($sensors);
//exit();
		return view('sensor.index', compact('sensors','projectatusers'));
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
		$sensunits = Sensunit::orderBy('id', 'desc')->whereIn('project_id', $projectatuserIds)->pluck('name', 'id')->toArray();;
        return view('sensor.create', compact('projectatusers','sensunits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$sensor = new Sensor();
            $sensor->name = $request->input("name");
            $sensor->address = $request->input("address");
            $sensor->ctgain = $request->input("ctgain");
            $sensor->ctoffset = $request->input("ctoffset");
			$sensor->yscalemax = $request->input("yscalemax");
			$sensor->yscalemin = $request->input("yscalemin");
            $sensor->limitupper = $request->input("limitupper");
			$sensor->limitunder = $request->input("limitunder");
			$sensor->alertmode = $request->input("alertmode");
            $sensor->sensunit_id = $request->input("sensunit_id");
            $sensor->project_id = $request->input("project_id");
			$sensor->save();

		return redirect()->route('sensor.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$sensor = Sensor::findOrFail($id);		
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
		return view('sensor.show', compact('sensor','projectatusers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$sensor = Sensor::findOrFail($id);
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
		
		$projectatuserIds = Projectatuser::select('id')->orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('id')->toArray();
		$sensunits = Sensunit::orderBy('id', 'desc')->whereIn('project_id', $projectatuserIds)->pluck('name', 'id')->toArray();;
		
		return view('sensor.edit', compact('sensor','projectatusers','sensunits'));
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
		$sensor = Sensor::findOrFail($id);
		$sensor->name = $request->input("name");
		$sensor->address = $request->input("address");
		$sensor->ctgain = $request->input("ctgain");
		$sensor->ctoffset = $request->input("ctoffset");
		$sensor->ctgain = $request->input("ctgain");
		$sensor->yscalemax = $request->input("yscalemax");
		$sensor->yscalemin = $request->input("yscalemin");
        $sensor->limitupper = $request->input("limitupper");
		$sensor->limitunder = $request->input("limitunder");
		$sensor->alertmode = $request->input("alertmode");
		$sensor->project_id = $request->input("project_id");
		$sensor->save();
		return redirect()->route('sensor.index')->with('message', 'Item created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$sensor = Sensor::findOrFail($id);
		$sensor->delete();
		return redirect()->route('sensor.index')->with('message', 'Item created successfully.');
    }
}
