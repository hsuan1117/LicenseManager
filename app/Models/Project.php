<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function codes(){
        return $this->hasMany(Code::class);
    }

    public function tokens(){
        return $this->hasMany(Token::class);
    }
}
