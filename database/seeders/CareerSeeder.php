<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        $carreras = [
            'TICS',
            'Gestión Empresarial',
            'Ingeniería Industrial',
            'Química',
            'Medicina',
            'Electrónica'
        ];

        foreach ($carreras as $carrera) {
            Career::create(['nombre' => $carrera]);
        }
    }
}
