<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $student = [
        [
            'stuid' => '001',
            'stuname' => 'นายเริง ใจเที่ยง',
            'major' => 'เทคโนโลยีสารสนเทศ'
        ],
        [
            'stuid' => '002',
            'stuname' => 'นายโทนี่ ชอบดี',
            'major' => 'เทคโนโลยีสารสนเทศ'
        ],
        [
            'stuid' => '003',
            'stuname' => 'นายอาบัต ตาคัม',
            'major' => 'เทคโนโลยีสารสนเทศ'
        ]
    ];
    public function index()
    {
        $student = $this->student;
        return view('student', compact('student'));
    }
    public function create(Request $request)
    {
        $newStudent = [
            'stuid' => $request->stuid,
            'stuname' => $request->stuname,
            'major' => $request->major,
        ];
        $student = $this->student;
        $student[] = $newStudent;

        return view('student', compact('student'));
    }
    public function delete(Request $request)
    {
        $student = array_filter($this->student, function ($s) use ($request) {
            return $s['stuid'] != $request->stuid;
        });
        return view('student', compact('student'));
    }
    public function update(Request $request)
    {
        $student = $this->student;
        foreach ($student as &$s)
            if ($s['stuid'] == $request->stuid) {
                $s['stuname'] = $request->stuname;
                $s['major'] = $request->major;
            }
        return view('student', compact('student'));
    }
}
