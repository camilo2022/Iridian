<?php

namespace Database\Seeders;

use App\Models\ContactArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactArea::create(['name' => 'Soporte Tecnico']);
        ContactArea::create(['name' => 'Ventas']);
        ContactArea::create(['name' => 'Cobranza']);
        ContactArea::create(['name' => 'Comentarios generales']);
    }
}
