<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Province;
use App\Models\Career;
use App\Models\Category;
use App\Models\Certification;
use App\Models\Cooperation;
use App\Models\Product;
use App\Models\Transaction;
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
                'position'=>'Web Developer',
                'rank'=>'Senior',
                'start_date'=>'2020-11-22',
                'end_date'=>'2022-11-21',
            ],
            [
                'user_id'=>11,
                'position'=>'Web Developer',
                'rank'=>'Lead',
                'start_date'=>'2022-11-22',
                'end_date'=>'2025-11-21',
            ],
        ];
        foreach ($careers as $career) {
            Career::create($career);
        }

        $categories = [
            ['name'=>'Alat Penelitian',],
            ['name'=>'Bahan Kimia',],
            ['name'=>'Lain-lain',],
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }

        $certifications = [
            [
                'user_id'=>11,
                'name'=>'Sertifikasi Web Developer',
                'location'=>'Malang',
                'issue_date'=>'2022-11-22',
            ],
            [
                'user_id'=>12,
                'name'=>'Sertifikasi Akuntan',
                'location'=>'Surabaya',
                'issue_date'=>'2023-11-22',
            ],
        ];
        foreach ($certifications as $cert) {
            Certification::create($cert);
        }

        $cooperations = [
            [
                'user_id'=>11,
                'name'=>'Kerjasama 1',
                'start_date'=>'2022-10-22',
                'end_date'=>'2022-11-22',
            ],
            [
                'user_id'=>12,
                'name'=>'Kerjasama 2',
                'start_date'=>'2022-02-22',
                'end_date'=>'2022-04-23',
            ],
        ];
        foreach ($cooperations as $co) {
            Cooperation::create($co);
        }

        $products = [
            [
                'category_id'=>1,
                'name'=>'Mikroskop',
                'price' => '1234000',
                'stock' => '5',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae viverra metus. Donec commodo nisi dolor, sed sodales sapien luctus eu.',
            ],
            [
                'category_id'=>2,
                'name'=>'Boraks',
                'price' => '55000',
                'stock' => '10',
                'description' => 'Mauris commodo, nisi vel dapibus tristique, dolor ante viverra libero, quis semper dolor sapien non nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.'
            ],
        ];
        foreach ($products as $product) {
            Product::create($product);
        }

        $transactions = [
            ['user_id'=>11, 'reception'=>100000, 'loan'=>100000, 'date'=>'2023-01-08'],
            ['user_id'=>11, 'reception'=>220000, 'loan'=>120000, 'date'=>'2023-04-12'],
            ['user_id'=>12, 'reception'=>135000, 'loan'=>140000, 'date'=>'2023-11-20'],
            ['user_id'=>13, 'reception'=>330000, 'loan'=>800000, 'date'=>'2023-12-03'],
        ];
        foreach ($transactions as $tr) {
            Transaction::create($tr);
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
