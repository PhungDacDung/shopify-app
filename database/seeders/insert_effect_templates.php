<?php

namespace Database\Seeders;

use App\Models\EffectTemplate;
use Illuminate\Database\Seeder;

class insert_effect_templates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EffectTemplate::truncate();
        EffectTemplate::create([
            "name"         => "snow",
            "display_name" => "Snow",
            "description"  => "This effect only contain the white snow!",
        ]);
        EffectTemplate::create([
            "name"         => "snow-colorful",
            "display_name" => "Snow Colorful",
            "description"  => "This effect contains the colorful snow!",
            "options"      => [
                "theme"    => ["default", "colors", "blues", "pastel", "watermelon", "berry"],
                "min_size" => 2,
                "max_size" => 7
            ]
        ]);
        EffectTemplate::create([
            "name"         => "snow-flake",
            "display_name" => "Snow Flake",
            "description"  => "This effect contains the white snow flake!",
            "options"      => [
                "frames"   => 60,
                "count"    => 50,
                "lifetime" => 5000,//ms
                "maxSpeed" => 4,
                "maxSize"  => 15
            ]
        ]);
        EffectTemplate::create([
            "name"         => "snow-flake-colorful",
            "display_name" => "Snow Flake Colorful",
            "description"  => "This effect contains the colorful snow flake!",
        ]);
    }
}
