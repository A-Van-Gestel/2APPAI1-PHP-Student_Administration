<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Programme;
use Illuminate\Http\Request;
use Json;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programmes = Programme::orderBy('name')
            ->withCount('courses')
            ->get();
        $result = compact('programmes');
        Json::dump($result);
        return view('admin.programmes.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programme = new programme();
        $result = compact('programme');
        return view('admin.programmes.create', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:programmes,name'
        ]);

        $programme = new programme();
        $programme->name = $request->name;
        $programme->save();
        session()->flash('success', "The programme <b>$programme->name</b> has been added");
        return redirect('admin/programmes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function show(Programme $programme)
    {
        $courses = Course::where(
            function ($query) use ($programme) {
            $query->where('programme_id', 'like', $programme->id);
            })
            ->orderBy('name')
            ->get();
        //dd($courses);

        // Send to page
        $result = compact('programme', 'courses');
        Json::dump($result);
        return view('admin.programmes.show', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {
        $result = compact('programme');
        Json::dump($result);
        return view('admin.programmes.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programme $programme)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:programmes,name,' . $programme->id
        ]);
        $programme->name = $request->name;
        $programme->save();
        session()->flash('success', 'The programme has been updated');
        return redirect('admin/programmes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programme)
    {
        $programme->delete();
        session()->flash('success', "The programme <b>$programme->name</b> has been deleted");
        return redirect('admin/programmes');
    }
}
