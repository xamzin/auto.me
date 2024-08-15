<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Timing;
use App\Models\Worker;
use Carbon\Carbon;

class CarService
{
    public function getCars(array $validated = null): array
    {
//        if (array_key_exists('worker', $validated)) {$worker_id = (int)$validated['worker'];} else {$worker_id = null;}
//        if (array_key_exists('dt', $validated)) {$dt = $validated['dt'];} else {$dt = null;}
//        if (array_key_exists('comfort', $validated)) {$comfort_id = (int)$validated['comfort'];} else {$comfort_id = null;}
//        if (array_key_exists('model', $validated)) {$model_id = (int)$validated['model'];} else {$model_id = null;}

        $request = $this->getValidateExists($validated, ['worker' => 'worker_id', 'dt' => 'dt', 'model' => 'model_id', 'comfort' => 'comfort_id']);

        $free = array();
        if (isset($request['worker_id'])) {
            if (!isset($request['dt'])) $request['dt'] = Carbon::now()->addHour(3);
            $rules = Worker::find($request['worker_id'])->rule;
            foreach ($rules as $rule) {
                if (Timing::query()
                        ->where('car_id', $rule->car_id)
                        ->where('start', '<', $request['dt'])
                        ->where('end', '>', $request['dt'])
                        ->doesntExist()) {
                    if (isset($request['model_id']) AND isset($request['comfort_id'])) {
                        if ($rule->car_id === (int)$request['model_id'] AND Car::find($rule->car_id)->comfort->id === (int)$request['comfort_id']) {
                            $free[] = $this->getCarInfo($rule->car_id);
                        }
                    } else {
                        if (isset($request['model_id'])) {
                            if ($rule->car_id === (int)$request['model_id']) {
                                $free[] = $this->getCarInfo($rule->car_id);
                            }
                        } elseif (isset($request['comfort_id'])) {
                            if (Car::find($rule->car_id)->comfort->id === (int)$request['comfort_id']) {
                                $free[] = $this->getCarInfo($rule->car_id);
                            }
                        } else {
                            $free[] = $this->getCarInfo($rule->car_id);
                        }
                    }
                }
            }
        }
        return $free;
    }

    public function getCarInfo(int $id): array
    {
        return array_merge(Car::find($id)->toArray(), $this->getDriverInfo($id), $this->getComfortInfo($id));
    }

    public function getDriverInfo(int $id): array
    {
        $driver = Car::find($id)->driver->toArray();
        $driver['driver_name'] = $driver['name'];
        unset($driver['name']);
        return $driver;
    }

    public function getComfortInfo(int $id)
    {
        $comfort = Car::find($id)->comfort->toArray();
        $comfort['comfort_name'] = $comfort['name'];
        unset($comfort['name']);
        return $comfort;
    }

    private function getValidateExists(array $validated, array $rulesKey = null): array
    {
        $result = array();
        foreach ($rulesKey as $key => $value) {
            if (array_key_exists($key, $validated)) {
                $result[$value] = $validated[$key];
            } else {
                $result[$value] = null;
            }
        }
        return $result;
    }

}
