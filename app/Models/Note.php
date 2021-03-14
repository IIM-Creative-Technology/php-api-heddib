<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['note', 'student_id', 'course_id'];

    /**
     * Retourne l'étudiant qui a cette note
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Retourne le cours lié à cette note
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
