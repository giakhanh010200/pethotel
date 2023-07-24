<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
class Service extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'name' => 'training',
                'image' => 'training.png',
                'about' => 'Working and obedience are how well they learn the tasks and commands that you teach them. To get your dog to be obedient, you should focus on training that uses obedience techniques and the specific behaviors you want from them. Both aversive- and reward-based training have been proven to work.',
                'price' => 0
            ],
            [
                'name' => 'grooming',
                'image' => 'grooming.png',
                'about' => 'Exams, vaccines and diagnostics all play a part in keeping your pet healthy, but good hygiene is important too. Our pet hotel offers a wide variety of pet grooming services to promote healthier hygiene habits. Your pet’s coat, ears and nails will receive the care they deserve from our professional groomer. Grooming appointments are also ideal for examining your pet’s skin and ears for issues like skin tags, lesions, or other hidden problems.',
                'price' => 150000,
            ],
            [
                'name' => 'transport',
                'image' => 'transport.png',
                'about' => "Pet shipping is an industry that involves transporting animals, specifically pets, often by plane. This service is commonly used when the animal's owner is moving house. However, it can also be used when transporting animals for other reasons, such as performing in dog shows.",
                'price' => 300000,
            ],
            [
                'name' => 'diet',
                'image' => 'diet.png',
                'about' => 'If your pet is on special diets, you are free to bring can i bring in your own food? We actually encourage pet parents to bring their dog’s normal food with them when they come to the hotel. If you cannot or would rather not supply your own food, or if we run out of your dog’s food while you’re away, we’ll be happy to accommodate your dog by feeding him or her with our house food.',
                'price' => 0,
            ],
            [
                'name' => 'vet',
                'image' => 'vet.png',
                'about' => 'Our facility is equipped with a high- standard lab, to ensure the best diagnostics.In emergency situations, where conservative treatment is not helping, we step in with an invasive treatment. Dental cleaning, tooth extraction, and much more is provided by us to ensure that the smile of your pet will always melt you. On site pharmacy with a wide variety of prescription and over the counter medicine will keep your pet current on his or her medications.',
                'price' => 400000,
            ],
            [
                'name' => 'daycare',
                'image' => 'daycare.png',
                'about' => 'Daycare for your pet is the perfect solution for those times when you are busy running errands, having your house painted, or any occasion when your pet needs to be away from home for the day. Your pet will have a fun-filled day playing, relaxing, and getting all the special attention it needs and deserves in a safe, supervised setting. Your pet will receive plenty of one-on-one attention and playtime from our staff members!',
                'price' => 100000
            ],
        ]);
    }
}
