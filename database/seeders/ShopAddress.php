<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopAddress extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_address')->insert([
            [
                'address' => '90 Láng Hạ, Đống Đa, Hà Nội',
                'open' => '08:00:00',
                'close' => '21:00:00',
                'map_place' => "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.5194355045733!2d105.80930911550693!3d21.01189228600749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab621d4af8b9%3A0x32479e6d11d623b4!2zOTAgTMOhbmcgSOG6oSwgxJDhu5FuZyDEkGEsIEjDoCBO4buZaSwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1637724539780!5m2!1sen!2s' width='600' height='450' style='border:0;' loading='lazy'></iframe>",
            ],
            [
                'address' => '606 Đường 3/2, Phường 14, Quận 10, Thành phố Hồ Chí Minh',
                'open' => '08:00:00',
                'close' => '21:00:00',
                'map_place' => "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.5658302078473!2d106.65937571540536!3d10.767905892327276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ee9b4cb7daf%3A0xb5824f89fff48710!2zNjA2IMSQxrDhu51uZyAzLzIsIFBoxrDhu51uZyAxNCwgUXXhuq1uIDEwLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmggNzAwMDAwLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1637726332061!5m2!1sen!2s' width='600' height='450' style='border:0;' loading='lazy'></iframe>",
            ],
            [
                'address' => '50 Quán Thánh, Nguyễn Trung Trực, Ba Đình, Hà Nội',
                'open' => '08:00:00',
                'close' => '21:00:00',
                'map_place' => "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8041866859594!2d105.84358881550732!3d21.040519585992016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abba30677c0d%3A0xefbcc314842dccb1!2zNTAgUXXDoW4gVGjDoW5oLCBOZ3V54buFbiBUcnVuZyBUcuG7sWMsIEJhIMSQw6xuaCwgSMOgIE7hu5lpLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1637726093154!5m2!1sen!2s' width='600' height='450' style='border:0;' loading='lazy'></iframe>",
            ],
            [
                'address' => '322 Nguyễn Văn Cừ, Ngọc Lâm, Long Biên, Hà Nội',
                'open' => '08:00:00',
                'close' => '21:00:00',
                'map_place' => "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.6876342893024!2d105.87317531550731!3d21.045180985989425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abd605be1851%3A0x9cb1818e57121099!2zMzIyIMSQLiBOZ3V54buFbiBWxINuIEPhu6ssIE5n4buNYyBMw6JtLCBMb25nIEJpw6puLCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1637725958687!5m2!1sen!2s' width='600' height='450' style='border:0;' loading='lazy'></iframe>",
            ],

        ]);
    }
}
