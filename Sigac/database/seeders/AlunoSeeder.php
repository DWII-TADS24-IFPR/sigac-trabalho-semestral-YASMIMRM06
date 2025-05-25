<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AlunoSeeder extends Seeder
{
    public function run()
    {
        // Busca turmas e usuários existentes
        $turmaADS2023 = Turma::where('ano', 2023)
            ->whereHas('curso', fn($q) => $q->where('sigla', 'ADS'))
            ->firstOrFail();

        $turmaINFO2023 = Turma::where('ano', 2023)
            ->whereHas('curso', fn($q) => $q->where('sigla', 'INFO'))
            ->firstOrFail();

        $professorADS = User::firstOrCreate(
            ['email' => 'prof.ads@example.com'],
            [
                'nome' => 'Professor ADS',
                'senha' => Hash::make('Professor@123'),
                'role_id' => 2, // ID da role de professor
            ]
        );

        $alunos = [
            [
                'nome' => 'Beatriz Yoshimi',
                'cpf' => '12345678901',
                'email' => 'beatriz.yoshimi@aluno.example.com',
                'senha' => Hash::make('Aluno@123'),
                'data_nascimento' => '2000-05-15',
                'telefone' => '41987654321',
                'user_id' => $professorADS->id,
                'curso_id' => $turmaADS2023->curso_id,
                'turma_id' => $turmaADS2023->id,
                'ativo' => true,
            ],
            [
                'nome' => 'Heloisa Abrantes',
                'cpf' => '98765432109',
                'email' => 'heloisa.abrantes@aluno.example.com',
                'senha' => Hash::make('Aluno@123'),
                'data_nascimento' => '2001-03-22',
                'telefone' => '41912345678',
                'user_id' => $professorADS->id,
                'curso_id' => $turmaINFO2023->curso_id,
                'turma_id' => $turmaINFO2023->id,
                'ativo' => true,
            ],
        ];

        foreach ($alunos as $aluno) {
            Aluno::firstOrCreate(
                ['email' => $aluno['email']],
                $aluno
            );
            $this->command->info("Aluno {$aluno['nome']} criado/atualizado!");
        }
    }
}