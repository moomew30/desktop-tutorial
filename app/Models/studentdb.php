<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentdb extends Model
{
    protected $table = 'tb_student';
    protected $fillable = [
        'stdid',
        'stdname',
        'major',
        'phone'
    ];
}
