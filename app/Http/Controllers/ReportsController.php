<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportsController extends Controller
{
   public function index()
   {
    $current_hour = Carbon::now()->format('H');
      return view('reports.index');
   }
}
