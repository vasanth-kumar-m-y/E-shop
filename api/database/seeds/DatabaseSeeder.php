<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    protected $categories = ['cars', 'books', 'clothing', 'computers', 
        'electronics', 'jewelery', 'accessories', 'movies', 
        'music', 'shoes',  'arts'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Model::unguard();

        //truncate tables: 

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $tablesToReset  = [
            'users',
            'roles',
            'role_user',
            'password_resets',
            'products',
            'cart',
            'categories',
            'product_categories',
        ];
        foreach($tablesToReset as $table) {
            DB::table($table)->truncate();
        }
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // categories:

        sort($this->categories);
        
        foreach($this->categories as $category)
        {
            DB::table('categories')->insert([
                'name' => $category,
            ]);
        }
        
        //role

        $role_admin = new \App\Models\Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'A Admin User';
        $role_admin->save();

        $role_user = new \App\Models\Role();
        $role_user->name = 'customer';
        $role_user->description = 'A Customer User';
        $role_user->save();


        // users:

        $users = factory(App\Models\User::class, 3)->create();

        $role_admin = \App\Models\Role::where('name', 'admin')->first();
        $role_user  = \App\Models\Role::where('name', 'customer')->first();

        foreach ($users as $key => $value) {
           if($key == 0){
                $value->roles()->attach($role_admin);
           }else{
                $value->roles()->attach($role_user);
           }
        }
        

        // products:

        $products = collect();
        for($i = 1; $i < 5; $i++) {

            $seller = $users->random();

            $product = factory(App\Models\Product::class)->create([
                'seller_id' => 1,
            ]);
            $products->push($product);

            // product categories:

            $total = count($this->categories);
            $middleTop = ceil( $total / 2);
        
            $product->categories()->sync([rand(1, $middleTop - 1), rand($middleTop, $total)]);
        }


        // sales:

        /*$sales = collect();
        for($i = 1; $i < count($products) * 2; $i++) {

            $product = $products->random();
            $buyer = collect($users)->forget($product->seller_id)->random(); 

            $sale = \App\Models\Sale::create([
                'buyer_id' => $buyer->id,
                'seller_id' => $product->seller_id,
                'product_id' => $product->id,
                'price' => $price = $product->price,
                'quantity' => $quantity = 1,        
                'total' => $price * $quantity,
                'created_at' => ($created_at = $faker->dateTimeBetween($product->created_at, 'now')),
                'updated_at' => $created_at,                    
            ]);
            $sales->push($sale);
        }*/


        // favourites:

       /* $favourites = collect();
        foreach($users as $user) {

            $favourites = [];
            $productsSelected = $products->random(rand(3, 5));
            foreach($productsSelected as $product){
                $favourites[$product->id] = 
                    ['created_at' => $faker->dateTimeBetween($product->created_at, 'now')];
            }

            $user->favourites()->sync($favourites);
        }*/


        Model::reguard();
    }
}
