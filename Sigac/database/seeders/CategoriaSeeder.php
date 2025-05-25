<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Curso;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $cursoADS = Curso::where('sigla', 'ADS')->firstOrFail();
        $cursoINFO = Curso::where('sigla', 'INFO')->firstOrFail();

        $categorias = [
            [
                'nome' => 'Extensão',
                'descricao' => 'Atividades de extensão universitária',
                'maximo_horas' => 200,
                'curso_id' => $cursoADS->id,
                'icone' => 'fa-solid fa-globe',
                'cor' => '#3498db',
                'ativo' => true,
            ],
            [
                'nome' => 'Pesquisa',
                'descricao' => 'Atividades de pesquisa acadêmica',
                'maximo_horas' => 150,
                'curso_id' => $cursoADS->id,
                'icone' => 'fa-solid fa-flask',
                'cor' => '#2ecc71',
                'ativo' => true,
            ],
            [
                'nome' => 'Atividades Complementares',
                'descricao' => 'Atividades extracurriculares',
                'maximo_horas' => 100,
                'curso_id' => $cursoINFO->id,
                'icone' => 'fa-solid fa-certificate',
                'cor' => '#e74c3c',
                'ativo' => true,
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(
                ['nome' => $categoria['nome'], 
                $categoria
            );
            $this->command->info("Categoria {$categoria['nome']} criada/atualizada!");
        }
    }
}