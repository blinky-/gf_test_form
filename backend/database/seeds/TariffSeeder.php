<?php

use Illuminate\Database\Seeder;
use App\Src\Tariffs\Weekdays;
use App\Src\Tariffs\Models\Tariff;

class TariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tariffs = [
            ['plan 1', 120, [Weekdays::MON, Weekdays::FRI]],
            ['plan 2', 220, [Weekdays::TUE, Weekdays::FRI, Weekdays::SUN]],
            ['plan 3', 320, [Weekdays::TUE, Weekdays::THU]],
            ['plan 4', 420, [Weekdays::MON, Weekdays::FRI, Weekdays::SAT, Weekdays::SUN]],
            ['plan 5', 520, [Weekdays::MON, Weekdays::THU, Weekdays::FRI]],
            ['plan 6', 620, [Weekdays::SUN]],
            ['plan 7', 720, [Weekdays::SAT, Weekdays::SUN]],
            ['plan 8', 820, [Weekdays::FRI]],
        ];

        foreach ($tariffs as $tariff) {
            $tariff = [
                'name' => $tariff[0],
                'price' => $tariff[1],
                'delivery_days' => $tariff[2],
            ];

            Tariff::create($tariff);
        }
    }
}
