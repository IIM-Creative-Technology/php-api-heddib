<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'age', 'arrival_year', 'promotion_id'];

    /**
     * Retourne la promotion de l'étudiant
     */
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
