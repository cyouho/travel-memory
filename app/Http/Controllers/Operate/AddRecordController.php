<?php

namespace App\Http\Controllers\Operate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddRecordController extends Controller
{
    //
    public function index()
    {
        return view('Operate.AddRecord.add_record_layer');
    }
}
