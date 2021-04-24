<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{

    protected $table = 'tbluserinfo';
    
    protected $fillable = [ 'UserID', 'Username', 'Password'];

    public $timestamps = false;
    protected $primaryKey = 'UserID';
}