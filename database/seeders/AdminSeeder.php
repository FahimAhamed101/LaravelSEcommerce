<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Admin::factory(1)->create();


\DB::table('products')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'laptop',
                    'slug' => 'laptop',
                    'qty' => 5,
                    'price' => 300,
                    'old_price' => 777,
                    'discount' => 61,
                    'description' => '<p>jjhh</p>',
                    'thumbnail' => '/storage/images/products/1761947185_Fast_API_for_Scalable_Microservices_1af758e0dc(2).png',
                    'first_image' => NULL,
                    'second_image' => NULL,
                    'third_image' => NULL,
                    'status' => 1,
                    'category_id' => 1,
                    'subcategory_id' => 1,
                    'childcategory_id' => 1,
                    'brand_id' => 1,
                    'created_at' => '2025-10-02 23:59:36',
                    'updated_at' => '2025-10-31 21:46:25'
                ],
            ]
        );

    }
}