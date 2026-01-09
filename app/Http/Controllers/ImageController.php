<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function index(){
        $images = DB::table('images')->orderBy('id', 'desc')->get();
        return view('upload', compact('images'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        //รับไฟล์รูป
        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();

        //บันทึกไฟล์ลงโฟล์เดอร์ public/uploads
        $file->move(public_path('uploads'), $filename);

        //บันทึกข้อมูลเข้า DB
        DB::table('images')->insert([
            'title' => $request->title,
            'filename' => $filename,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'อัพโหลดรูปภาพเรียบร้อย');
    }
}