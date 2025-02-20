<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentQualification extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'qualification'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
