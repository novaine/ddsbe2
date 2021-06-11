<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJob extends Model{
    protected $table = 'tbluserjobs';

    protected $fillable = [
        'JobID', 'JobName',
    ];

    public $timestamp = false;

    protected $primaryKey = 'JobID';
}