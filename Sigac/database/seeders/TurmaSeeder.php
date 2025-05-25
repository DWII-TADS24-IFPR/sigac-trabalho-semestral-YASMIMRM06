<?php

namespace Database\Seeders;

use App\Models\Turma;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TurmaSeeder extends Seeder
{
    public function run()
    {
        $cursoADS = \App\Models\Curso::where('sigla', 'ADS')->firstOrFail();
        $cursoINFO = \App\Models\Curso::where('sigla', 'INFO')->firstOrFail();

        $turmas = [
            [
                'nome' => 'ADS 2023/1',
                'codigo' => 'ADS2023-1',
                'curso_id' => $cursoADS->id,
                'ano' => 2023,
                'semestre' => 1,
                'data_inicio' => Carbon::create(2023, 3, 1),
                'data_fim' => Carbon::create(2023, 7, 15),
                'vagas' => 40,
                'sala' => 'Lab 101',
                'horario' => '19:00-22:30',
                'status' => 'concluida',
            ],
            [
                'nome' => 'ADS 2024/1',
                'codigo' => 'ADS2024-1',
                'curso_id' => $cursoADS->id,
                'ano' => 2024,
                'semestre' => 1,
                'data_inicio' => Carbon::create(2024, 3, 1),
                'data_fim' => Carbon::create(2024, 7, 15),
                'vagas' => 40,
                'sala' => 'Lab 102',
                'horario' => '19:00-22:30',
                'status' => 'ativa',
            ],
            [
                'nome' => 'INFO 2023/2',
                'codigo' => 'INFO2023-2',
                'curso_id' => $cursoINFO->id,
                'ano' => 2023,
                'semestre' => 2,
                'data_inicio' => Carbon::create(2023, 8, 1),
                'data_fim' => Carbon::create(2023, 12, 15),
                'vagas' => 30,
                'sala' => 'Lab 201',
                'horario' => '14:00-17:30',
                'status' => 'concluida',
            ],
        ];

        foreach ($turmas as $turma) {
            Turma::firstOrCreate(
                ['codigo' => $turma['codigo']],
                $turma
            );
            $this->command->info("Turma {$turma['nome']} criada/atualizada!");
        }
    }
}