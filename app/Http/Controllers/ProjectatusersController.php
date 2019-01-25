<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Projectatuser;

class ProjectatusersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$projectatusers = Projectatuser::orderBy('id', 'desc')->where('user_id', Auth::id())->paginate(10);
		return view('projectatusers.index', compact('projectatusers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('projectatusers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$projectatuser = new Projectatuser();

		$projectatuser->name = $request->input("name");
        $projectatuser->user_id = Auth::id();
		$projectatuser->save();

		return redirect()->route('projectatusers.index')->with('message', 'Item created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$projectatuser = Projectatuser::findOrFail($id);

		return view('projectatusers.show', compact('projectatuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$projectatuser = Projectatuser::findOrFail($id);

		return view('projectatusers.edit', compact('projectatuser'));
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
		$projectatuser = Projectatuser::findOrFail($id);

		$projectatuser->name = $request->input("name");
        //$projectatuser->user_id = $request->input("user_id");

		$projectatuser->save();

		return redirect()->route('projectatusers.index')->with('message', 'Item updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$projectatuser = Projectatuser::findOrFail($id);
		$projectatuser->delete();
		return redirect()->route('projectatusers.index')->with('message', 'Item deleted successfully.');

    }
}
