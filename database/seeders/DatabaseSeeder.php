<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds. php artisan db:seed
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('color_product')->delete();
        DB::table('product_size')->delete();
        DB::table('products')->delete();
        DB::table('childcategories')->delete();
        DB::table('subcategories')->delete();
        DB::table('categories')->delete();
        DB::table('brands')->delete();
        DB::table('colors')->delete();
        DB::table('sizes')->delete();

        // Categories
        $categories = [
            ['id' => 1, 'name' => 'Electronics', 'slug' => 'electronics'],
            ['id' => 2, 'name' => 'Clothing', 'slug' => 'clothing'],
            ['id' => 3, 'name' => 'Home & Garden', 'slug' => 'home-garden'],
            ['id' => 4, 'name' => 'Sports', 'slug' => 'sports'],
        ];

        DB::table('categories')->insert($categories);

        // Subcategories
        $subcategories = [
            // Electronics subcategories
            ['id' => 1, 'name' => 'Laptops', 'slug' => 'laptops', 'category_id' => 1],
            ['id' => 2, 'name' => 'Smartphones', 'slug' => 'smartphones', 'category_id' => 1],
            ['id' => 3, 'name' => 'Tablets', 'slug' => 'tablets', 'category_id' => 1],
            ['id' => 4, 'name' => 'Cameras', 'slug' => 'cameras', 'category_id' => 1],
            
            // Clothing subcategories
            ['id' => 5, 'name' => 'Men\'s Clothing', 'slug' => 'mens-clothing', 'category_id' => 2],
            ['id' => 6, 'name' => 'Women\'s Clothing', 'slug' => 'womens-clothing', 'category_id' => 2],
            ['id' => 7, 'name' => 'Kids\' Clothing', 'slug' => 'kids-clothing', 'category_id' => 2],
            
            // Home & Garden subcategories
            ['id' => 8, 'name' => 'Furniture', 'slug' => 'furniture', 'category_id' => 3],
            ['id' => 9, 'name' => 'Kitchen', 'slug' => 'kitchen', 'category_id' => 3],
            
            // Sports subcategories
            ['id' => 10, 'name' => 'Fitness', 'slug' => 'fitness', 'category_id' => 4],
            ['id' => 11, 'name' => 'Outdoor', 'slug' => 'outdoor', 'category_id' => 4],
        ];

        DB::table('subcategories')->insert($subcategories);

        // Childcategories
        $childcategories = [
            // Laptop childcategories
            ['id' => 1, 'name' => 'Gaming Laptops', 'slug' => 'gaming-laptops', 'subcategory_id' => 1],
            ['id' => 2, 'name' => 'Business Laptops', 'slug' => 'business-laptops', 'subcategory_id' => 1],
            ['id' => 3, 'name' => 'Ultrabooks', 'slug' => 'ultrabooks', 'subcategory_id' => 1],
            
            // Smartphone childcategories
            ['id' => 4, 'name' => 'Android Phones', 'slug' => 'android-phones', 'subcategory_id' => 2],
            ['id' => 5, 'name' => 'iPhones', 'slug' => 'iphones', 'subcategory_id' => 2],
            ['id' => 6, 'name' => 'Budget Phones', 'slug' => 'budget-phones', 'subcategory_id' => 2],
            
            // Men's Clothing childcategories
            ['id' => 7, 'name' => 'T-Shirts', 'slug' => 't-shirts', 'subcategory_id' => 5],
            ['id' => 8, 'name' => 'Jeans', 'slug' => 'jeans', 'subcategory_id' => 5],
            ['id' => 9, 'name' => 'Jackets', 'slug' => 'jackets', 'subcategory_id' => 5],
            
            // Furniture childcategories
            ['id' => 10, 'name' => 'Living Room', 'slug' => 'living-room', 'subcategory_id' => 8],
            ['id' => 11, 'name' => 'Bedroom', 'slug' => 'bedroom', 'subcategory_id' => 8],
        ];

        DB::table('childcategories')->insert($childcategories);

        // Brands
        $brands = [
            ['id' => 1, 'name' => 'Apple', 'slug' => 'apple'],
            ['id' => 2, 'name' => 'Samsung', 'slug' => 'samsung'],
            ['id' => 3, 'name' => 'Dell', 'slug' => 'dell'],
            ['id' => 4, 'name' => 'HP', 'slug' => 'hp'],
            ['id' => 5, 'name' => 'Lenovo', 'slug' => 'lenovo'],
            ['id' => 6, 'name' => 'Sony', 'slug' => 'sony'],
            ['id' => 7, 'name' => 'Nike', 'slug' => 'nike'],
            ['id' => 8, 'name' => 'Adidas', 'slug' => 'adidas'],
            ['id' => 9, 'name' => 'IKEA', 'slug' => 'ikea'],
            ['id' => 10, 'name' => 'KitchenAid', 'slug' => 'kitchenaid'],
        ];

        DB::table('brands')->insert($brands);

        // Colors
        $colors = [
            ['id' => 1, 'name' => 'Black', 'slug' => 'black'],
            ['id' => 2, 'name' => 'White', 'slug' => 'white'],
            ['id' => 3, 'name' => 'Red', 'slug' => 'red'],
            ['id' => 4, 'name' => 'Blue', 'slug' => 'blue'],
            ['id' => 5, 'name' => 'Green', 'slug' => 'green'],
            ['id' => 6, 'name' => 'Yellow', 'slug' => 'yellow'],
            ['id' => 7, 'name' => 'Silver', 'slug' => 'silver'],
            ['id' => 8, 'name' => 'Gold', 'slug' => 'gold'],
            ['id' => 9, 'name' => 'Gray', 'slug' => 'gray'],
            ['id' => 10, 'name' => 'Pink', 'slug' => 'pink'],
        ];

        DB::table('colors')->insert($colors);

        // Sizes
        $sizes = [
            ['id' => 1, 'name' => 'XS', 'slug' => 'xs'],
            ['id' => 2, 'name' => 'S', 'slug' => 's'],
            ['id' => 3, 'name' => 'M', 'slug' => 'm'],
            ['id' => 4, 'name' => 'L', 'slug' => 'l'],
            ['id' => 5, 'name' => 'XL', 'slug' => 'xl'],
            ['id' => 6, 'name' => 'XXL', 'slug' => 'xxl'],
            ['id' => 7, 'name' => '32GB', 'slug' => '32gb'],
            ['id' => 8, 'name' => '64GB', 'slug' => '64gb'],
            ['id' => 9, 'name' => '128GB', 'slug' => '128gb'],
            ['id' => 10, 'name' => '256GB', 'slug' => '256gb'],
            ['id' => 11, 'name' => '15 inch', 'slug' => '15-inch'],
            ['id' => 12, 'name' => '17 inch', 'slug' => '17-inch'],
        ];

        DB::table('sizes')->insert($sizes);

        // Products - Using integer values for prices
        $products = [
            [
                'id' => 1,
                'name' => 'Gaming Laptop Pro',
                'slug' => 'gaming-laptop-pro',
                'qty' => 15,
                'price' => 1299, // Changed to integer
                'old_price' => 1599, // Changed to integer
                'discount' => 19,
                'description' => '<p>High-performance gaming laptop with RGB keyboard and powerful graphics card.</p>',
                'thumbnail' => '/storage/images/products/laptop-pro.jpg',
                'first_image' => '/storage/images/products/laptop-pro-1.jpg',
                'second_image' => '/storage/images/products/laptop-pro-2.jpg',
                'third_image' => '/storage/images/products/laptop-pro-3.jpg',
                'status' => 1,
                'category_id' => 1,
                'subcategory_id' => 1,
                'childcategory_id' => 1,
                'brand_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'iPhone 15 Pro',
                'slug' => 'iphone-15-pro',
                'qty' => 25,
                'price' => 999, // Changed to integer
                'old_price' => 1099, // Changed to integer
                'discount' => 9,
                'description' => '<p>Latest iPhone with advanced camera system and A17 Pro chip.</p>',
                'thumbnail' => '/storage/images/products/iphone-15-pro.jpg',
                'first_image' => '/storage/images/products/iphone-15-pro-1.jpg',
                'second_image' => '/storage/images/products/iphone-15-pro-2.jpg',
                'third_image' => '/storage/images/products/iphone-15-pro-3.jpg',
                'status' => 1,
                'category_id' => 1,
                'subcategory_id' => 2,
                'childcategory_id' => 5,
                'brand_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Men\'s Casual T-Shirt',
                'slug' => 'mens-casual-t-shirt',
                'qty' => 50,
                'price' => 25, // Changed to integer
                'old_price' => 30, // Changed to integer
                'discount' => 17,
                'description' => '<p>Comfortable cotton t-shirt for everyday wear.</p>',
                'thumbnail' => '/storage/images/products/mens-tshirt.jpg',
                'first_image' => '/storage/images/products/mens-tshirt-1.jpg',
                'second_image' => '/storage/images/products/mens-tshirt-2.jpg',
                'third_image' => '/storage/images/products/mens-tshirt-3.jpg',
                'status' => 1,
                'category_id' => 2,
                'subcategory_id' => 5,
                'childcategory_id' => 7,
                'brand_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Modern Coffee Table',
                'slug' => 'modern-coffee-table',
                'qty' => 8,
                'price' => 200, // Changed to integer
                'old_price' => 250, // Changed to integer
                'discount' => 20,
                'description' => '<p>Elegant modern coffee table for your living room.</p>',
                'thumbnail' => '/storage/images/products/coffee-table.jpg',
                'first_image' => '/storage/images/products/coffee-table-1.jpg',
                'second_image' => '/storage/images/products/coffee-table-2.jpg',
                'third_image' => '/storage/images/products/coffee-table-3.jpg',
                'status' => 1,
                'category_id' => 3,
                'subcategory_id' => 8,
                'childcategory_id' => 10,
                'brand_id' => 9,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'name' => 'Wireless Earbuds',
                'slug' => 'wireless-earbuds',
                'qty' => 30,
                'price' => 80, // Changed to integer
                'old_price' => 100, // Changed to integer
                'discount' => 20,
                'description' => '<p>High-quality wireless earbuds with noise cancellation.</p>',
                'thumbnail' => '/storage/images/products/earbuds.jpg',
                'first_image' => '/storage/images/products/earbuds-1.jpg',
                'second_image' => '/storage/images/products/earbuds-2.jpg',
                'third_image' => '/storage/images/products/earbuds-3.jpg',
                'status' => 1,
                'category_id' => 1,
                'subcategory_id' => 2,
                'childcategory_id' => 4,
                'brand_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('products')->insert($products);

        // Color-Product relationships
        $colorProduct = [
            // Gaming Laptop colors
            ['color_id' => 1, 'product_id' => 1],
            ['color_id' => 7, 'product_id' => 1],
            ['color_id' => 9, 'product_id' => 1],
            
            // iPhone colors
            ['color_id' => 1, 'product_id' => 2],
            ['color_id' => 2, 'product_id' => 2],
            ['color_id' => 8, 'product_id' => 2],
            ['color_id' => 4, 'product_id' => 2],
            
            // T-Shirt colors
            ['color_id' => 1, 'product_id' => 3],
            ['color_id' => 2, 'product_id' => 3],
            ['color_id' => 3, 'product_id' => 3],
            ['color_id' => 4, 'product_id' => 3],
            ['color_id' => 5, 'product_id' => 3],
            
            // Coffee Table colors
            ['color_id' => 1, 'product_id' => 4],
            ['color_id' => 2, 'product_id' => 4],
            ['color_id' => 9, 'product_id' => 4],
            
            // Earbuds colors
            ['color_id' => 1, 'product_id' => 5],
            ['color_id' => 2, 'product_id' => 5],
            ['color_id' => 7, 'product_id' => 5],
        ];

        DB::table('color_product')->insert($colorProduct);

        // Product-Size relationships
        $productSize = [
            // Gaming Laptop sizes
            ['size_id' => 11, 'product_id' => 1],
            ['size_id' => 12, 'product_id' => 1],
            
            // iPhone sizes (storage)
            ['size_id' => 8, 'product_id' => 2],
            ['size_id' => 9, 'product_id' => 2],
            ['size_id' => 10, 'product_id' => 2],
            
            // T-Shirt sizes
            ['size_id' => 2, 'product_id' => 3],
            ['size_id' => 3, 'product_id' => 3],
            ['size_id' => 4, 'product_id' => 3],
            ['size_id' => 5, 'product_id' => 3],
            ['size_id' => 6, 'product_id' => 3],
            
            // Coffee Table (no specific sizes)
            ['size_id' => 3, 'product_id' => 4], // Using M as default
            
            // Earbuds sizes
            ['size_id' => 3, 'product_id' => 5], // One size fits most
        ];

        DB::table('product_size')->insert($productSize);

        $this->command->info('Demo data seeded successfully!');
    }
}