<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skema_operasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'skema_operasi';

}