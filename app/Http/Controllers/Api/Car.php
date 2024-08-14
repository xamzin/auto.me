<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CarService;

class Car extends Controller
{
    public function free(Request $request)
    {
        $cars = new CarService();
        return $cars->getCars(
            $request->input('worker'),
            $request->input('dt'),
            $request->input('comfort'),
            $request->input('model'),
        );
    }
}
