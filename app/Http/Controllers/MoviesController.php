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

        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $genres = genre::pluck('name', 'id')->all();

         return view('movies.create', compact('genres'));
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

        $input = $request->all();

        movies::create($request->all());
       

        return redirect('movies');
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
        $movies = movies::findOrFail($id);

        $genres = genre::pluck('name', 'id')->all();

        return view('movies.edit',compact('movies','genres'));
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
        $movies = movies::findOrFail($id);

        $input = $request->all();
        $released_date = str_replace("-", "", $input['released_date']);
        $input['released_date'] = Carbon::parse($released_date)->format('Y-m-d');
        $request->replace($input);

        $input = $request->all();

        $movies->update($input);

        return redirect('movies');
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
        movies::findOrFail($id)->delete();

        return redirect('movies');
    }
}
