<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function main()
    {
        return view('main');
    }
    public function people()
    {
        // $teacher = ['ครูฉันท์พัฒน์','ครูภีรภัท','ครูปกรณ์','ครูสุภาพร','ครูพงศ์ศิริ','ครูเบญจวรรณ'];
        $teacher = [
            [
                'teaid' => '101',
                'teaname' => 'ครูปกรณ์ ปัญญาดี',
                'major' => 'เทคโนโลยีสารสนเทศ'
            ],
            [
                'teaid' => '102',
                'teaname' => 'ครูฉันทพัฒน์ สมนึกเจริญสุข',
                'major' => 'เทคโนโลยีสารสนเทศ'
            ],
            [
                'teaid' => '103',
                'teaname' => 'ครูพงศ์ศิริ ธรรมวุฒิ',
                'major' => 'เทคโนโลยีสารสนเทศ'
            ]
        ];
        return view('people', compact('teacher'));
        // return view ('people',[
        // 'fname' => 'นายสมชาย',
        // 'lname' => 'ใจดี',
        // 'teacher' => $teacher
        // ]);
    }
    public function major()
    {
        return view('major');
    }
    public function contact()
    {
        return view('contact');
    }
}
