<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Boarding extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boarding')->insert([
            [
                'name' => 'Deluxe Boarding',
                'price' => '500000',
                'details'=> '<p><strong>Amenities:</strong>&nbsp; climate control, live cameras</p><br>
                <p><strong>View:</strong>&nbsp; courtyard</p><br>
                <p><strong>Size:</strong>&nbsp; 16m²</p><br>
                <p><strong>Bed Type:</strong>&nbsp; bed with mattress and pillows</p><br>
                <p><strong>Categories:</strong>&nbsp; single pet suite</p><br>',
                'description' => 'For those requiring more exclusive accommodations, our suites will provide your pampered pet with a more spacious private room. We have TVs playing pet-friendly movies in each suite and offer private walks for bathroom breaks morning, noon and night.<br>

                Bright and airy, each room has access to separate outdoor and sheltered indoor play space for exercise and socialization. Each suite has a nice homey atmosphere and mattress-style toddler sized bed.<br>

                The single pet suites are separated from the standard rooms for a more peaceful, private environment and are as well perfect for multiple pets in a family. Rooms are cleaned and sanitized daily.<br>

                ',
            ],
            [
                'name' => 'Standard Boarding',
                'price' => '350000',
                'details'=> '<p><strong>Amenities:</strong>&nbsp; classical music, climate control</p><br>
                <p><strong>View:</strong>&nbsp; courtyard</p><br>
                <p><strong>Size:</strong>&nbsp; 16m²</p><br>
                <p><strong>Bed Type:</strong>&nbsp; donut bed</p><br>
                <p><strong>Categories:</strong>&nbsp; shared pet suite</p><br>',
                'description' => 'Shared suites are the perfect environment for sociable pets that enjoy the wonders of communal living. Each of the shared rooms has single beds available for each pet staying there, and is attended around the clock by trained professionals.<br>

                All of the boarding rooms are equipped with at least one air purifier to circulate clean air flow. Instead of televisions, soothing music is provided during the day for a more relaxed and enjoyable stay.<br>

                At check-in, each pet is assigned an individual area to safely store extra food and any extra belongings required during their stay. If desired, please bring toys, bedding or other small items, which might make your pet feel more at home.',
            ],
        ]);
    }
}
