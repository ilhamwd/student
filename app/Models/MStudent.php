<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MStudent extends Model
{
    use HasFactory;

    protected $table = 'm_student';
    protected $primaryKey = 'student_id';

    public $timestamps = false;
}
