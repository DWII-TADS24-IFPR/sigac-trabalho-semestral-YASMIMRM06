<?php

namespace Database\Seeders;

use App\Models\Nivel;
use Illuminate\Database\Seeder;

class NivelSeeder extends Seeder
{
    public function run()
    {
        $niveis = [
            [
                'nome' => 'Técnico',
                'descricao' => 'Cursos Técnicos',
                'ordem' => 1,
                'icone' => 'fa-certificate',
                'ativo' => true,
            ],
            [
                'nome' => 'Graduação',
                'descricao' => 'Cursos de Graduação',
                'ordem' => 2,
                'icone' => 'fa-graduation-cap',
                'ativo' => true,
            ],
            [
                'nome' => 'Pós-Graduação',
                'descricao' => 'Cursos de Pós-Graduação',
                'ordem' => 3,
                'icone' => 'fa-user-graduate',
                'ativo' => true,
            ],
            [
                'nome' => 'Extensão',
                'descricao' => 'Cursos de Extensão',
                'ordem' => 4,
                'icone' => 'fa-book-open',
                'ativo' => true,
            ],
        ];

        foreach ($niveis as $nivel) {
            Nivel::firstOrCreate(
                ['nome' => $nivel['nome']],
                $nivel
            );
            $this->command->info("Nível {$nivel['nome']} criado/atualizado!");
        }
    }
}