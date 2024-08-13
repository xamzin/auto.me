<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Car extends Controller
{
    public function free()
    {
        //
        return \App\Models\Car::all();
    }
}
