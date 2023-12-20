<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeType;

class IncomeTypeController extends Controller
{
    
    public function index()
    {
        $types = IncomeType::paginate(10);

        return view('pages.income.type', [ 'types' => $types ]);
    }
}
