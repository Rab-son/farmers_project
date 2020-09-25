<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    // View Maize Calculator
    public function viewMaizeCalculator(Request $request){  
        return view ('admin.calculations.view_calculations');
    }
}
