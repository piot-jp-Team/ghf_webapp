<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tweets = Tweet::orderBy('id', 'desc')->paginate(10);

		return view('tweets.index', compact('tweets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tweets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$tweet = new Tweet();

		$tweet->title = $request->input("title");
        $tweet->body = $request->input("body");

		$tweet->save();

		return redirect()->route('tweets.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tweet = Tweet::findOrFail($id);

		return view('tweets.show', compact('tweet'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tweet = Tweet::findOrFail($id);

		return view('tweets.edit', compact('tweet'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$tweet = Tweet::findOrFail($id);

		$tweet->title = $request->input("title");
        $tweet->body = $request->input("body");

		$tweet->save();

		return redirect()->route('tweets.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$tweet = Tweet::findOrFail($id);
		$tweet->delete();

		return redirect()->route('tweets.index')->with('message', 'Item deleted successfully.');
	}

}
