<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActualIncomeBreakdown extends Model
{
    use HasFactory;

    protected $fillable = [
        'income_source_id',
        'amount'
    ];
}
