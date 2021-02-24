<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    //When Fillable error, can use the $guarded
    protected $guarded = [];

    public function profileImage(){

        //This doesn't work
        //return '/storage/'.($this->image) ? $this->image : 'profile/XiYx5c6LgN2Sln6nJMujkjHdBIY907K90ZKxsZiv.png';
        
        $imagePath=($this->image) ? $this->image : 'profile/XiYx5c6LgN2Sln6nJMujkjHdBIY907K90ZKxsZiv.png';
        return '/storage/'.$imagePath;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function followers(){
        return $this->belongsToMany(User::class);
    }
}
