<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            KaryawanSeeder::class,
            SupplierSeeder::class,
            MusimSeeder::class,
            RakSeeder::class,
            KategoriKainSeeder::class,
            KainSeeder::class,
            UkuranSeeder::class,           
            KategoriProdukSeeder::class,
            ProdukSeeder::class,
            // ProdukWarnaSeeder::class,
            // ProdukUkuranSeeder::class,
            ResepSeeder::class,
            // NotaProduksiSeeder::class,
            // HasilProdukSeeder::class,
            // NotaKainSeeder::class,
            // RincianKainSeeder::class,
            
            NotaBeliSeeder::class,
            // NotaBeliDetailSeeder::class,
            NotaJualSeeder::class,
            // NotaJualDetailSeeder::class,
            
        ]);
    }
}
