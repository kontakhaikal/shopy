<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use App\Models\ShippingOption;
use Illuminate\Database\Seeder;

class ShippingOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => "Aceh",
                "methods" => [
                    "Standard" => 20000,
                    "Express" => 35000
                ]
            ],
            [
                "name" => "Sumatera Utara",
                "methods" => [
                    "Standard" => 25000,
                    "Express" => 38000
                ]
            ],
            [
                "name" => "Sumatera Barat",
                "methods" => [
                    "Standard" => 24000,
                    "Express" => 37000
                ]
            ],
            [
                "name" => "Riau",
                "methods" => [
                    "Standard" => 23000,
                    "Express" => 36000
                ]
            ],
            [
                "name" => "Jambi",
                "methods" => [
                    "Standard" => 23000,
                    "Express" => 36000
                ]
            ],
            [
                "name" => "Sumatera Selatan",
                "methods" => [
                    "Standard" => 24000,
                    "Express" => 37000
                ]
            ],
            [
                "name" => "Bengkulu",
                "methods" => [
                    "Standard" => 24000,
                    "Express" => 37000
                ]
            ],
            [
                "name" => "Lampung",
                "methods" => [
                    "Standard" => 24000,
                    "Express" => 37000
                ]
            ],
            [
                "name" => "Kepulauan Bangka Belitung",
                "methods" => [
                    "Standard" => 25000,
                    "Express" => 38000
                ]
            ],
            [

                "name" => "Kepulauan Riau",
                "methods" => [
                    "Standard" => 25000,
                    "Express" => 38000
                ]
            ],
            [

                "name" => "DKI Jakarta",
                "methods" => [
                    "Standard" => 5000,
                    "Express" => 10000
                ]
            ],
            [

                "name" => "Jawa Barat",
                "methods" => [
                    "Standard" => 6000,
                    "Express" => 12000
                ]
            ],
            [

                "name" => "Jawa Tengah",
                "methods" => [
                    "Standard" => 6000,
                    "Express" => 12000
                ]
            ],
            [

                "name" => "Yogyakarta",
                "methods" => [
                    "Standard" => 6000,
                    "Express" => 12000
                ]
            ],
            [

                "name" => "Jawa Timur",
                "methods" => [
                    "Standard" => 5500,
                    "Express" => 11000
                ]
            ],
            [

                "name" => "Banten",
                "methods" => [
                    "Standard" => 6000,
                    "Express" => 12000
                ]
            ],
            [

                "name" => "Bali",
                "methods" => [
                    "Standard" => 6500,
                    "Express" => 13000
                ]
            ],
            [

                "name" => "Nusa Tenggara Barat",
                "methods" => [
                    "Standard" => 7000,
                    "Express" => 14000
                ]
            ],
            [

                "name" => "Nusa Tenggara Timur",
                "methods" => [
                    "Standard" => 7500,
                    "Express" => 15000
                ]
            ],
            [

                "name" => "Kalimantan Barat",
                "methods" => [
                    "Standard" => 8000,
                    "Express" => 16000
                ]
            ],
            [

                "name" => "Kalimantan Tengah",
                "methods" => [
                    "Standard" => 8000,
                    "Express" => 16000
                ]
            ],
            [

                "name" => "Kalimantan Selatan",
                "methods" => [
                    "Standard" => 8000,
                    "Express" => 16000
                ]
            ],
            [

                "name" => "Kalimantan Timur",
                "methods" => [
                    "Standard" => 8000,
                    "Express" => 16000
                ]
            ],
            [

                "name" => "Kalimantan Utara",
                "methods" => [
                    "Standard" => 8500,
                    "Express" => 17000
                ]
            ],
            [
                "name" => "Sulawesi Utara",
                "methods" => [
                    "Standard" => 9000,
                    "Express" => 18000
                ]
            ],
            [

                "name" => "Sulawesi Tengah",
                "methods" => [
                    "Standard" => 9000,
                    "Express" => 18000
                ]
            ],
            [
                "name" => "Sulawesi Selatan",
                "methods" => [
                    "Standard" => 9000,
                    "Express" => 18000
                ]
            ],
            [
                "name" => "Sulawesi Tenggara",
                "methods" => [
                    "Standard" => 9000,
                    "Express" => 18000
                ]
            ],
            [

                "name" => "Gorontalo",
                "methods" => [
                    "Standard" => 9000,
                    "Express" => 18000
                ]
            ],
            [
                "name" => "Sulawesi Barat",
                "methods" => [
                    "Standard" => 9000,
                    "Express" => 18000
                ]
            ],
            [
                "name" => "Maluku",
                "methods" => [
                    "Standard" => 9500,
                    "Express" => 19000
                ]
            ],
            [
                "name" => "Maluku Utara",
                "methods" => [
                    "Standard" => 9500,
                    "Express" => 19000
                ]
            ],
            [
                "name" => "Papua Barat",
                "methods" => [
                    "Standard" => 29000,
                    "Express" => 390000
                ]
            ],
            [
                "name" => "Papua",
                "methods" => [
                    "Standard" => 30000,
                    "Express" => 40000
                ]
            ]
        ];

        collect($data)->each(function (array $option) {
            $shippingOption = new ShippingOption();
            $shippingOption->name = $option['name'];

            $shippingOption->save();

            collect($option['methods'])->each(function ($v, $k) use ($shippingOption) {
                $shippingMethod = new ShippingMethod();
                $shippingMethod->name = $k;
                $shippingMethod->cost = $v;
                $shippingMethod->shipping_option_id = $shippingOption->id;
                $shippingMethod->save();
            });
        });
    }
}
