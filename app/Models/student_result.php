<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\student;

class student_result extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $primaryKey='student_id';
    protected $guarded=[];

    public function student() {
        return $this->hasOne(student::class, 'id', 'student_id');
    }
}
