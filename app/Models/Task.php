<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable=['task_name','description','user_id','status'];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
