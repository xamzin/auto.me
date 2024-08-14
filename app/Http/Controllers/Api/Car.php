<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Http\Resources\FreeCarResource;
use App\Services\CarService;

class Car extends Controller
{
    public function free(Request $request)
    {
        //dump($request->input('worker'));
            $cars = new CarService();
            return $cars->getCars($request->input('worker'));
        //return new FreeCarResource($cars);
    }
}
