<?php

namespace Database\Seeders;

use App\Models\Comprovante;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ComprovanteSeeder extends Seeder
{
    public function run()
    {
        $professorADS = User::where('email', 'prof.ads@example.com')->firstOrFail();
        $alunoBeatriz = Aluno::where('email', 'beatriz.yoshimi@aluno.example.com')->firstOrFail();
        $categoriaExtensao = Categoria::where('nome', 'Extensão')->firstOrFail();

        $comprovantes = [
            [
                'titulo' => 'Workshop de Laravel',
                'descricao' => 'Participação como ouvinte',
                'horas' => 20,
                'data_atividade' => Carbon::now()->subDays(15),
                'arquivo' => 'comprovantes/workshop_laravel.pdf',
                'status' => 'aprovado',
                'categoria_id' => $categoriaExtensao->id,
                'aluno_id' => $alunoBeatriz->id,
                'user_id' => $professorADS->id,
            ],
            [
                'titulo' => 'Minicurso de Git',
                'descricao' => 'Participação ativa com exercícios práticos',
                'horas' => 10,
                'data_atividade' => Carbon::now()->subDays(30),
                'arquivo' => 'comprovantes/minicurso_git.pdf',
                'status' => 'aprovado',
                'categoria_id' => $categoriaExtensao->id,
                'aluno_id' => $alunoBeatriz->id,
                'user_id' => $professorADS->id,
            ],
        ];

        foreach ($comprovantes as $comprovante) {
            Comprovante::firstOrCreate(
                ['titulo' => $comprovante['titulo'],
                $comprovante
            );
            $this->command->info("Comprovante '{$comprovante['titulo']}' criado/atualizado!");
        }
    }
}