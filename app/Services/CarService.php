<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Timing;
use App\Models\Worker;
use Carbon\Carbon;

final class CarService
{
    public function getCars(int $worker_id = null, string $dt = null, int $comfort_id = null, int $model_id = null): array
    {
        $free = array();
        if (isset($worker_id)) {
            if (!isset($dt)) $dt = Carbon::now()->addHour(3);
            $rules = Worker::find($worker_id)->rule;
            foreach ($rules as $rule) {
                if (Timing::query()
                        ->where('car_id', $rule->car_id)
                        ->where('start', '<', $dt)
                        ->where('end', '>', $dt)
                        ->doesntExist()) {
                    if (isset($model_id) AND isset($comfort_id)) {
                        if ($rule->car_id === $model_id AND Car::find($rule->car_id)->comfort->id === $comfort_id) {
                            $free[] = $this->getCarInfo($rule->car_id);
                        }
                    } else {
                        if (isset($model_id)) {
                            if ($rule->car_id === $model_id) {
                                $free[] = $this->getCarInfo($rule->car_id);
                            }
                        } elseif (isset($comfort_id)) {
                            if (Car::find($rule->car_id)->comfort->id === $comfort_id) {
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

}
