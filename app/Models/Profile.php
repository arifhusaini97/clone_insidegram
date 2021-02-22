<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    //When Fillable error, can use the $guarded
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
