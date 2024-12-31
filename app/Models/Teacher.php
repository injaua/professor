<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Classroom;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use hasFactory;

//campos a serem inseridos no banco
    protected $fillable = [
        'name',
        'subject',
    ];


//relacao: muitos-para-muitos

public function classrooms(){

    return $this->belongsToMany(Classroom::class);
}
}
