<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignRole extends Model
{
    protected $table = 'users';
    protected $guarded = [];
    public function role(){
        return $this->belongsTo(Role::class);
    }
}
