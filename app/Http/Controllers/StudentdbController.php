<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\studentdb;

class StudentdbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentdb = studentdb::all();
        return view('studentdb.index', compact('studentdb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('studentdb.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'stdid' => 'required',
            'stdname' => 'required',
            'major' => 'required',
            'phone' => 'required',
        ]);

        studentdb::create($request->all());
        return redirect()->route('studentdb.index');
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
    public function edit(studentdb $studentdb)
    {
        return view('studentdb.update', compact('studentdb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, studentdb $studentdb)
    {
        $request->validate([
            'stdid' => 'required',
            'stdname' => 'required',
            'major' => 'required',
            'phone' => 'required',
        ]);

        $studentdb->update($request->all());
        return redirect()->route('studentdb.index')->with('success', 'อัปเดตข้อมูลครูสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(studentdb $studentdb)
    {
        $studentdb->delete();
        return redirect()->route('studentdb.index')->with('success', 'ลบข้อมูลสำเร็จ');
    }
}
