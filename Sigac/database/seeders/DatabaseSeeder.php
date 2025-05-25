<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class, // Added roles first for proper permissions
            UserSeeder::class, // Added user seeder
            NivelSeeder::class,
            EixoSeeder::class,
            CursoSeeder::class,
            TurmaSeeder::class,
            CategoriaSeeder::class,
            AlunoSeeder::class,
            DocumentoSeeder::class, // Documents before comprovantes for FK relations
            ComprovanteSeeder::class,
            DeclaracaoSeeder::class,
        ]);
        
        $this->command->info('All seeders completed successfully!');
    }
}