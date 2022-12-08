<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Province;
use App\Models\Career;
use App\Models\User;
use File;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = json_decode(File::get("database/data/users.json"));
        foreach ($users as $key => $value) {
            User::create([
                "id" => $value->id,
                "name" => $value->name,
                "email" => $value->email,
                "password" => $value->password,
                "phone" => $value->phone,
                "address" => $value->address,
                "birthday" => $value->birthday,
                "start_date" => $value->start_date,
                "end_date" => $value->end_date,
                "previlege" => $value->previlege,
                "status" => $value->status,
                "photo" => $value->photo,
            ]);
        }

        $careers = [
            [
                'user_id'=>11,
                'position'=>'Programmer',
                'rank'=>'Lead',
                'start_date'=>'2020-03-22',
                'end_date'=>'2025-11-27',
            ],
        ];
    
        foreach ($careers as $career) {
            Career::create($career);
        }

        // $provinces = json_decode(File::get("database/data/provinces.json"));
        // foreach ($provinces as $key => $value) {
        //     Province::create([
        //         "id" => $value->id,
        //         "name" => $value->name,
        //     ]);
        // }

        // $cities = json_decode(File::get("database/data/cities.json"));
        // foreach ($cities as $key => $value) {
        //     City::create([
        //         "id" => $value->id,
        //         "province_id" => $value->province_id,
        //         "name" => $value->name,
        //     ]);
        // }

        //Registration::factory(10)->create();
    }
}
