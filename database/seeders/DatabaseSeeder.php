<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\Worker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('drivers')->insert([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'name' => fake('ru_RU')->unique()->name(),
            ]);
        }

        $comforts = [
            'Премиум',
            'Люкс',
            'Бизнес',
            'Комфорт',
            'Эконом',
        ];

        foreach ($comforts as $comfort) {
            DB::table('comforts')->insert([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'name' => $comfort,
            ]);
            $i++;
        }

        $cars = [
            'Mersedes',
            'Tayota',
            'Hyundai',
            'ВАЗ',
            'Газ',
        ];

        $i = 1;
        foreach ($cars as $car) {
            DB::table('cars')->insert([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'model' => $car,
                'comfort_id' => $i,
                'driver_id' => $i,
            ]);
            $i++;
        }

        $positions = [
            'Генеральный директор',
            'Коммерческий директор',
            'Главный бухгалтер',
            'Руководитель отдела',
            'Разработчик',
            'Уборщица',
        ];

        foreach ($positions as $position) {
            DB::table('positions')->insert([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'name' => $position,
            ]);
        }

        $amount = 30; //кол-во сотрудников
        for ($i = 1; $i <= $amount; $i++) {
            DB::table('workers')->insert([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'name' => fake('ru_RU')->unique()->name(),
                'position_id' => rand(1, count($positions)),
            ]);
        }

        $rules = [
            1 => [1, 2, 3], //Генеральный директор
            2 => [2, 3, 4], //Коммерческий директор
            3 => [2, 3, 4, 5], //Главный бухгалтер
            4 => [3, 4, 5], //Руководитель отдела
            5 => [4, 5], //Разработчик
            //Уборщица - не может
        ];

        foreach ($rules as $key => $value) {
            foreach ($value as $item) {
                DB::table('rule_use_cars')->insert([
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),

                    'position_id' => $key,
                    'car_id' => $item,
                ]);
            }
        }

        for ($i = 1; $i < 100; $i++) {
            $cars = null;
            $worker_id = rand(1, $amount);
            $rules = Worker::find($worker_id)->rule;
            foreach ($rules as $rule) {
                $cars[] = $rule->car_id;
            }
            $dt = Carbon::now()->addHour(rand(4, 168))->roundMinute();
            if (is_array($cars)) {
                DB::table('timings')->insert([
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'car_id' => Arr::random($cars),
                    'worker_id' => $worker_id,
                    'start' => $dt,
                    'end' => $dt->addHour(rand(4,8)),
                ]);
            }
        }
    }
}
