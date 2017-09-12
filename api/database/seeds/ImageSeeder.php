<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ImageSeeder extends Seeder
{

    protected $imageGeneratorUrl = 'http://loremflickr.com/149/149/paradise';

    protected $destination = '/imgs/products';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $totalProd = \App\Models\Product::count();

        for($i=1; $i <= $totalProd ; $i++)
        {
            $from = $this->imageGeneratorUrl . '?random=' . $i;
            $to = public_path() . $this->destination . "/$i.jpg";
            echo "Loading image $i \n";
            copy($from, $to);            
        }
    }
}
