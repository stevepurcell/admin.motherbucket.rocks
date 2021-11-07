<?php

namespace App\Http\Controllers;

use App\Models\Songlist;
use App\Models\SongListGroup;
use App\Models\SongSonglist;
use Illuminate\Http\Request;

class SetlistGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SongListGroup::all();
        return view('setlistgroups.index', compact('data'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setlistgroups.create');        
    }

    public function store(Request $request)
    {

        // Validate form date
        $this->validate($request, [
            'name' => 'required | max:255',
        ]);


        // Process data and submit
        $group = new SongListGroup();
        $group->name = $request->name;
        $group->creator = auth()->user()->id;
        $group->private = $request->private;


        // If successful, redirect to show method
        if($group->save()) {
            return redirect()->route('setlistgroups.index')
                ->with('success', 'Setlist Group Created successfully!');
        } else {
            return redirect()->route('setlistgroups.create')
                ->with('error' , 'Error creating Setlist Group');;
        }
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $songs = SongSonglist::where('setlist_group_id', $id)->get();
        if($songs->count() > 0)
        {
            deleteSetlist($id);
            if(deleteSetlistGroup($id))
            {
                return redirect()->route('setlistgroups.index')
                ->with('success', 'Setlist Group deleted successfully!');
            } else {
                return redirect()->route('setlistgroups.index')
                ->with('error', 'Error deleting Setlist Group');
            }
        } else {
            if(deleteSetlistGroup($id))
            {
                return redirect()->route('setlistgroups.index')
                ->with('success', 'Setlist Group deleted successfully!');
            } else {
                return redirect()->route('setlistgroups.index')
                ->with('error', 'Error deleting Setlist Group');
            }
        }
    }
}
