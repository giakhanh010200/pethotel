<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            [
                'name' => 'food',
                'description' => 'Pet food is a specialty food for domesticated animals that is formulated according to their nutritional needs. Pet food generally consists of meat, meat byproducts, cereals, grain, vitamins, and minerals.',
            ],
            [
                'name' => 'toys',
                'description' => "Toys are important to your pet's well-being",
            ],
            [
                'name' => 'grooming & health',
                'description' => 'Necessary items for pet health',
            ],
            [
                'name' => 'accessories',
                'description' => 'A variety of pet accessories'
            ],
            [
                'name' => 'carriers',
                'description' => 'Pet carriers are small portable boxes, crates, or cages used to transport small animals such as cats, lap dogs, miniature pigs, ferrets, chickens, guinea pigs, and so on, from one location to another.'
            ]
        ]);
    }
}
