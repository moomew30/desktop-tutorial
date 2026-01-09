<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teachers::all();
        return view('teachers.index',compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teaid' => 'required',
            'teaimg' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'teaname' => 'required',
            'major' => 'required',
            'telephone' => 'required',
        ]);

        $file = $request->file('teaimg');
        $filename = $request->teaid.'_'.$file->getClientOriginalName();

        $file->move(public_path('teacherImage'), $filename);

        // Teachers::create($request->all());
        DB::table('tb_teacher')->insert([
            'teaid' => $request->teaid,
            'teaimg' => $filename,
            'teaname' => $request->teaname,
            'major' => $request->major,
            'telephone' => $request->telephone,
        ]);
        return redirect()->route('teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teachers $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teachers $teacher)
    {
        $request->validate([
            'teaid' => 'required',
            'teaname' => 'required',
            'major' => 'required',
            'telephone' => 'required',
            'teaimg' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['teaid', 'teaname', 'major', 'telephone']);

        // ถ้ามีการอัพโหลดรูปใหม่
        if ($request->hasFile('teaimg')) {
            $file = $request->file('teaimg');
            $filename = $request->teaid . '_' . $file->getClientOriginalName();
            $file->move(public_path('teacherImage'), $filename);
            $data['teaimg'] = $filename;
        }

        $teacher->update($data);

        return redirect()->route('teachers.index')->with('success', 'อัพเดทข้อมูลสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teachers $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'ลบข้อมูลสำเร็จ');
    }
}
