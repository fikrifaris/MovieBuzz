<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\movies;
use App\Models\members;
use App\Models\lending;
use Carbon\Carbon;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lending = lending::all();
        $movies = movies::pluck('title', 'id')->all();
        $members = members::pluck('name', 'id')->all();

  
        $active = \DB::select('select name, id from members where is_active = ?', [1]);
        $act_member = Arr::pluck($active, 'name', 'id');
      

        return view('lending.index', compact('lending', 'movies', 'members', 'act_member'));
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
        $lending_date = str_replace("-", "", $input['lending_date']);
        $input['lending_date'] = Carbon::parse($lending_date)->format('Y-m-d');
        $request->replace($input);

        $lending = new lending();
        $lending->movie_id = $request->movies;
        $lending->member_id = $request->members;
        $lending->lending_date = $request->lending_date;
        $lending->lateness_charge = $request->lateness_charge;
        $lending->save();
        return response()->json($lending);
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
        $lending = lending::findorFail($id);
        $movies = movies::pluck('title', 'id')->all();
        $members = members::pluck('name', 'id')->all();


        return response()->json($lending);
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
        $lending = lending::findorFail($request->id);
        
        $input = $request->all();
        $lending_date = str_replace("-", "", $input['lending_date']);
        $input['lending_date'] = Carbon::parse($lending_date)->format('Y-m-d');
        $request->replace($input);

        $lending->movie_id = $request->movies;
        $lending->member_id = $request->members;
        $lending->lending_date = $request->lending_date;
        $lending->lateness_charge = $request->lateness_charge;
        $lending->save();
        return response()->json($lending);
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
        lending::findorFail($id)->delete();

        return response()->json(['success'=>'Record has been deleted']);
    }
}
