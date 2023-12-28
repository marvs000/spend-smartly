<?php

namespace App\Models;

use App\Models\IncomeType;
use App\Models\IncomeCategory;
use App\Models\ActualIncomeBreakdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncomeSource extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'income_date',
        'income_category',
        'income_type',
        'expected_income',
        'actual_income',
    ];

    public function actual_incomes(): HasMany
    {
        return $this->hasMany(ActualIncomeBreakdown::class);
    }

    public function category(): HasOne
    {
        return $this->hasOne(IncomeCategory::class, 'id', 'income_category');
    }

    public function type(): HasOne
    {
        return $this->hasOne(IncomeType::class, 'id', 'income_type');
    }
}
