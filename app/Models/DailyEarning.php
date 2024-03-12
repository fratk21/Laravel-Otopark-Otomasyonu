<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyEarning extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'earning'];
}
