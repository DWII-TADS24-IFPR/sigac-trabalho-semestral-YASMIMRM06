<?php

namespace Database\Seeders;

use App\Models\Eixo;
use Illuminate\Database\Seeder;

class EixoSeeder extends Seeder
{
    public function run()
    {
        $eixos = [
            [
                'nome' => 'Tecnologia',
                'descricao' => 'Cursos relacionados à Tecnologia da Informação',
                'icone' => 'fa-laptop-code',
                'cor' => '#3498db',
                'ativo' => true,
            ],
            [
                'nome' => 'Saúde',
                'descricao' => 'Cursos da área da Saúde',
                'icone' => 'fa-user-md',
                'cor' => '#e74c3c',
                'ativo' => true,
            ],
            [
                'nome' => 'Gestão',
                'descricao' => 'Cursos de Gestão e Negócios',
                'icone' => 'fa-briefcase',
                'cor' => '#2ecc71',
                'ativo' => true,
            ],
            [
                'nome' => 'Humanas',
                'descricao' => 'Cursos de Ciências Humanas',
                'icone' => 'fa-graduation-cap',
                'cor' => '#f39c12',
                'ativo' => true,
            ],
        ];

        foreach ($eixos as $eixo) {
            Eixo::firstOrCreate(
                ['nome' => $eixo['nome']],
                $eixo
            );
            $this->command->info("Eixo {$eixo['nome']} criado/atualizado!");
        }
    }
}