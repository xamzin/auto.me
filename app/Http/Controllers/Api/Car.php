<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CarService;

class Car extends Controller
{
    public function free(Request $request)
    {
        $validated = $request->validate([
            'worker' => 'bail|integer|nullable',
            'dt' => 'bail|date|nullable',
            'comfort' => 'bail|integer|nullable',
            'model' => 'bail|integer|nullable',
        ]);

        $cars = new CarService();
        return $cars->getCars($validated);
    }
}
