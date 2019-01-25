<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Shieldmodule;
use App\Projectatuser;

class ShieldmoduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$projectatuserIds = Projectatuser::select('id')->orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('id')->toArray();
		$shieldmodules = Shieldmodule::orderBy('id', 'desc')->whereIn('project_id', $projectatuserIds)->paginate(10);
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
		return view('shieldmodule.index', compact('shieldmodules','projectatusers'));
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();
        return view('shieldmodule.create',compact('projectatusers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$shieldmodule = new Shieldmodule();
            $shieldmodule->name = $request->input("name");
            $shieldmodule->module_id = $request->input("module_id");
			$shieldmodule->project_id = $request->input("project_id");
			$shieldmodule->save();

		return redirect()->route('shieldmodule.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$shieldmodule = Shieldmodule::findOrFail($id);

		return view('shieldmodule.show', compact('shieldmodule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$shieldmodule = Shieldmodule::findOrFail($id);
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->pluck('name', 'id')->toArray();

		return view('shieldmodule.edit', compact('shieldmodule','projectatusers'));
		
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
		$shieldmodule = Shieldmodule::findOrFail($id);
        $shieldmodule->name = $request->input("name");
        $shieldmodule->module_id = $request->input("module_id");
		$shieldmodule->project_id = $request->input("project_id");
		$shieldmodule->save();
		return redirect()->route('shieldmodule.index')->with('message', 'Item created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$shieldmodule = Shieldmodule::findOrFail($id);
		$shieldmodule->delete();
		return redirect()->route('shieldmodule.index')->with('message', 'Item created successfully.');
    }
}
