<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Show;
use Validator;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $shows = Show::all();
          return view('index', compact('shows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'show_name' => 'required|max:255',
            'genre' => 'required|max:255',
            'imdb_rating' => 'required|numeric',
            'lead_actor' => 'required|max:255',
        ]);
        $show = Show::create($validatedData);
   
        return redirect('/shows')->with('success', 'Show is successfully saved');
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
         $show = Show::findOrFail($id);
         return view('edit', compact('show'));
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
         $validatedData = $request->validate([
            'show_name' => 'required|max:255',
            'genre' => 'required|max:255',
            'imdb_rating' => 'required|numeric',
            'lead_actor' => 'required|max:255',
        ]);
        Show::whereId($id)->update($validatedData);
        return redirect('/shows')->with('success', 'Show is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = Show::findOrFail($id);
        $show->delete();
        return redirect('/shows')->with('success', 'Show is successfully deleted');
    }
    ////////////////////// APIS functions---////////////////////////////////////
    
    public function showlist() {
		return response()->json(Show::get(), 200);
	}
	
	public function showlistByID($id) {
		$show = Show::find($id);
		if (is_null($show)) {
			return response()->json(["message" => 'Record not found!'], 404);
		}
		return response()->json(show::find($id), 200);
	}
	
    public function showlistSave(Request $request) {
		$rules = [
		'show_name' =>'required|max:255|unique:shows',
		'genre' => 'required|max:255',
		'imdb_rating' => 'required|numeric',
		'lead_actor' => 'required|max:255',
		];
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
		    return response()->json($validator->errors(), 400);
		}    
		$showlist = Show::create($request->all());
		return response()->json($showlist, 201);
	}
	
	public function showlistUpdate(Request $request, $id) {
		$show = Show::find($id);
		if (is_null($show)) { 
			return response()->json(["message" => 'Record not found!'], 404);
		}
		/*$rules = [
		'show_name' =>'required|max:255|unique:shows',
		'genre' => 'required|max:255',
		'imdb_rating' => 'required|numeric',
		'lead_actor' => 'required|max:255',
		];
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
		    return response()->json($validator->errors(), 400);
		}*/
		
		$show->update($request->all());
		return response()->json($show, 200);
	}
	
	public function showlistDelete(Request $request, $id) {
		$show = Show::find($id);
		if (is_null($show)) {
			return response()->json(["message" => 'Record not found!'], 404);
		}
		$show->delete();
		return response()->json(null, 204);
	}
	
}
