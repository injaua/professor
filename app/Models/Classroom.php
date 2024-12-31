<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;


    protected $fillable = ['nr_sala'];


    public function teachers(){

        return $this->belongsTomany(Teacher::class);
    }
}
