<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guest;
use Carbon\Carbon;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 20; $i++) {
            $createdAt = Carbon::now()->subDays(rand(1, 30))->subHours(rand(1, 24))->subMinutes(rand(1, 60))->subSeconds(rand(1, 60));
            $updatedAt = $createdAt->copy()->addDays(rand(0, 30))->addHours(rand(0, 24))->addMinutes(rand(0, 60))->addSeconds(rand(0, 60));

            Guest::create([
                'ID_identity' => 'ID' . $i,
                'name' => 'Guest' . $i,
                'address' => 'Address ' . $i,
                'region' => ['TEGAL', 'SLAWI', 'BREBES', 'PEMALANG', 'JATENG', 'LUAR_JATENG'][rand(0, 5)],
                'birth_date' => Carbon::now()->subYears(rand(18, 60)),
                'work' => ['WIRASWASTA', 'PNS', 'TNI_POLRI', 'GURU', 'PELAJAR', 'FREELANCER', 'BURUH', 'PETANI', 'NELAYAN', 'PEDAGANG', 'PENGUSAHA', 'TIDAK_BEKERJA'][rand(0, 11)],
                'education' => ['TS', 'SD', 'SMP', 'SMA', 'PT'][rand(0, 4)],
                'gender' => ['L', 'P', 'N'][rand(0, 2)],
                'type_guest' => ['WEB', 'WORK_IN_GUEST', 'OWNER', 'TRAVEL', 'COORPORATE_FAMILY', 'ENTERTAINMENT'][rand(0, 5)],
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }
    }
}
