<?php

namespace Database\Seeders;

use App\Models\Students;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Students::create([
            'name' => 'NOMBRE 1',
            'lastname' => 'APELLIDO 1',
            'document' => '12345',
            'phone' => '987653210',
            'email' => 'prueba1@gmail.com'
        ]);

        Students::create([
            'name' => 'NOMBRE 2',
            'lastname' => 'APELLIDO 2',
            'document' => '123456',
            'phone' => '987653210',
            'email' => 'prueba2@gmail.com'
        ]);
        
        Students::create([
            'name' => 'NOMBRE 3',
            'lastname' => 'APELLIDO 3',
            'document' => '1234567',
            'phone' => '987653210',
            'email' => 'prueba3@gmail.com'
        ]);
    }
}
