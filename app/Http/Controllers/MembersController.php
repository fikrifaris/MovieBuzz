<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\members;
use Carbon\Carbon;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $members = members::all();

        return view('members.index', compact('members'));
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
        $members = new members();
        $members->name = $request->name;
        $members->age = $request->age;
        $members->address = $request->address;
        $members->telephone = $request->telephone;
        $members->identity_number = $request->identity_number;
        $members->date_of_joined = Carbon::now();
        $members->is_active = 0;
        $members->save();
        return response()->json($members);
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
         $members = members::findorFail($id);

        return response()->json($members);
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
        $members = members::findorFail($request->id);
        $members->name = $request->name;
        $members->age = $request->age;
        $members->address = $request->address;
        $members->telephone = $request->telephone;
        $members->identity_number = $request->identity_number;
        $members->is_active = $request->is_active;
        $members->save();
        return response()->json($members);
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
        members::findorFail($id)->delete();

        return response()->json(['success'=>'Record has been deleted']);
    }
}
