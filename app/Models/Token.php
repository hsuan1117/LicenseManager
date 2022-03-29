<?php

namespace App\Models;

use ALajusticia\Expirable\Traits\Expirable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    use Expirable;

    protected $guarded = [];

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
