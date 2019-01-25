<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Sensunit;
use App\Projectatuser;
use App\Shieldmodule;

class SensunitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$projectatuserIds = Projectatuser::select('id')->orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('id')->toArray();
		$sensunits = Sensunit::orderBy('id', 'desc')->whereIn('project_id', $projectatuserIds)->paginate(10);
		$shieldmodules = Shieldmodule::orderBy('id', 'desc')->whereIn('project_id', $projectatuserIds)->pluck('name', 'id')->toArray();
//var_dump($sensors);
//exit();
		return view('sensunit.index', compact('sensunits','projectatusers','shieldmodules'));
		
		
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
		$sensunits = Sensunit::orderBy('id', 'desc')->whereIn('project_id', $projectatuserIds)->paginate(10);
		$shieldmodules = Shieldmodule::orderBy('id', 'desc')->whereIn('project_id', $projectatuserIds)->pluck('name', 'id')->toArray();
        return view('sensunit.create', compact('sensunits','projectatusers','shieldmodules'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$sensunit = new Sensunit();
            $sensunit->name = $request->input("name");
            $sensunit->channel = $request->input("channel");
            $sensunit->shield_id = $request->input("shield_id");
			$sensunit->project_id = $request->input("project_id");
			$sensunit->save();

		return redirect()->route('sensunit.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$sensunit = Sensunit::findOrFail($id);
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
		return view('sensunit.show', compact('sensunit','projectatusers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$sensunit = Sensunit::findOrFail($id);
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
		$projectatuserIds = Projectatuser::select('id')->orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('id')->toArray();
		$shieldmodules = Shieldmodule::orderBy('id', 'desc')->whereIn('project_id', $projectatuserIds)->pluck('name', 'id')->toArray();
        return view('sensunit.edit', compact('sensunit','shieldmodules','projectatusers'));
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
		$sensunit = Sensunit::findOrFail($id);
		$sensunit->name = $request->input("name");
		$sensunit->channel = $request->input("channel");
		$sensunit->shield_id = $request->input("shield_id");
		$sensunit->project_id = $request->input("project_id");
		$sensunit->save();
		return redirect()->route('sensunit.index')->with('message', 'Item created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$sensunit = Sensunit::findOrFail($id);
		$sensunit->delete();
		return redirect()->route('sensunit.index')->with('message', 'Item created successfully.');
    }
}
