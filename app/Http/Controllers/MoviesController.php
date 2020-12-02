<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\movies;
use App\Models\genre;
use Carbon\Carbon;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $movies = movies::all();
        $genres = genre::pluck('name', 'id')->all();

        return view('movies.index', compact('movies', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
       
        $input = $request->all();
        $released_date = str_replace("-", "", $input['released_date']);
        $input['released_date'] = Carbon::parse($released_date)->format('Y-m-d');
        $request->replace($input);

        
        // $input = $request->all();
        // movies::create($request->all());

        $movies = new movies();
        $movies->title = $request->title;
        $movies->genre = $request->genre;
        $movies->released_date = $request->released_date;
        $movies->save();
        return response()->json($movies);
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
        $movies = movies::findorFail($id);
         $genres = genre::pluck('name', 'id')->all();

        return response()->json($movies);
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
        $movies = movies::findorFail($request->id);
        
        $input = $request->all();
        $released_date = str_replace("-", "", $input['released_date']);
        $input['released_date'] = Carbon::parse($released_date)->format('Y-m-d');
        $request->replace($input);

        $movies->title = $request->title;
        $movies->genre = $request->genre;
        $movies->released_date = $request->released_date;
        $movies->save();
        return response()->json($movies);
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
        movies::findorFail($id)->delete();

        return response()->json(['success'=>'Record has been deleted']);
    }
}
