<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Worker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $drivers = [
            'Сергей',
            'Максим',
            'Пётр',
            'Владимир',
            'Алексей',
        ];

        foreach ($drivers as $driver) {
            DB::table('drivers')->insert([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'name' => $driver,
            ]);
        }

        $cars = [
            'Mersedes' => 'Премиум',
            'Tayota' => 'Люкс',
            'Hyundai' => 'Бизнес',
            'ВАЗ' => 'Комфорт',
            'Газ' => 'Эконом',
        ];

        $i = 1;
        foreach ($cars as $key => $value) {
            DB::table('cars')->insert([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'name' => $key,
                'comfort' => $value,
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

        for($i = 1; $i <= 20; $i++) {
            DB::table('workers')->insert([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'name' => 'Имя'.$i.' Фамилия'.$i,
                'position_id' => rand(1, 6),
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
                DB::table('rules')->insert([
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),

                    'position_id' => $key,
                    'car_id' => $item,
                ]);
            }
        }

//        for($i = 1; $i < 20; $i++) {
//            DB::table('timings')->insert([
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now(),
//
//                'name' => 'Имя Фамилия'.$i,
//                'position_id' => rand(1, 10),
//            ]);
//        }
    }
}
