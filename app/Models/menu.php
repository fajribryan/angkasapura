<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $table ='menu';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public $timestamps = false;
}
