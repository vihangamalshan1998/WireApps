<?php

namespace App\Models;

use App\Models\Assignment;
use App\Models\Mark;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
