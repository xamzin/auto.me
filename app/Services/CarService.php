<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Timing;
use App\Models\Worker;
use Carbon\Carbon;

final class CarService
{
    public function getCars(int $worker_id, $comfort = null, $model = null): array
    {
        $dt = Carbon::now()->addHour(3);
        $free=array();
        $rules = Worker::find($worker_id)->rule;
        foreach ($rules as $rule) {
            if(!count(Timing::query()
                ->where('car_id', $rule->car_id)
                ->where('start', '<', $dt)
                ->where('end', '>', $dt)
                ->get())) {
                $free[] = $this->getCarInfo($rule->car_id);
                //$free[] = $this->getDriverInfo($rule->car_id);
            }
        }
        return $free;
    }

    public function getCarInfo(int $id)
    {
        //return Car::find($id);
        //$car = Car::find($id);
        return array_merge(Car::find($id)->toArray(), $this->getDriverInfo($id));
    }

    public function getDriverInfo(int $id)
    {
        $driver = Car::find($id)->driver->toArray();
        $driver['driver_name'] = $driver['name'];
        unset($driver['name']);
        return $driver;
    }

}
//    public function __construct(public readonly UserRepository $userRepository)
//    {
//    }

//    public function getUser(int $userId): User
//    {
//        //Выполняем различные бизнес проверки
//        ...
//        $user = $this->userRepository->find($userId);
//
//        if ($user === null) {
//            throw new UserNotFoundException("User {$userId} not found.');
//        }
//
//        return $user;
//    }
//}
