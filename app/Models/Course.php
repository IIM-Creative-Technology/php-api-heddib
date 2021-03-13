<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'start_date', 'end_date', 'intervenant_id', 'promotion_id'];

    /**
     * Retourne l'intervenant de ce cours
     */
    public function intervenant()
    {
        return $this->belongsTo(Intervenant::class);
    }

    /**
     * Retourne la promotion qui suit ce cours
     */
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
