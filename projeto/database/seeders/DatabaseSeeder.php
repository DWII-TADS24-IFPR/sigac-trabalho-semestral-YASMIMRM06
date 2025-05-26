<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Nivel;
use App\Models\Turma;
use App\Models\Curso;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Comprovante;
use App\Models\Declaracao;
use App\Models\Documento;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $niveis = [
            ['nome' => 'Fundamental'],
            ['nome' => 'Médio'],
            ['nome' => 'Técnico'],
            ['nome' => 'Graduação'],
            ['nome' => 'Pós-Graduação'],
            ['nome' => 'Mestrado'],
            ['nome' => 'Doutorado'],
        ];

        foreach ($niveis as $nivel) {
            Nivel::create($nivel);
        }

        $cursos = [
            [
                'nome' => 'Matemática',
                'sigla' => 'MAT',
                'total_horas' => 60,
                'nivel_id' => 1
            ],
            [
                'nome' => 'Física',
                'sigla' => 'FIS',
                'total_horas' => 80,
                'nivel_id' => 2
            ],
            [
                'nome' => 'Química',
                'sigla' => 'QUI',
                'total_horas' => 70,
                'nivel_id' => 3
            ],
            [
                'nome' => 'Biologia',
                'sigla' => 'BIO',
                'total_horas' => 90,
                'nivel_id' => 4
            ],
            [
                'nome' => 'Engenharia',
                'sigla' => 'ENG',
                'total_horas' => 120,
                'nivel_id' => 5
            ],
            [
                'nome' => 'Direito',
                'sigla' => 'DIR',
                'total_horas' => 100,
                'nivel_id' => 6
            ],
            [
                'nome' => 'Medicina',
                'sigla' => 'MED',
                'total_horas' => 150,
                'nivel_id' => 7
            ],
        ];

        foreach ($cursos as $curso) {
            Curso::create($curso);
        }

        $categorias = [
            [
                'nome' => 'Categoria A',
                'max_horas' => 20,
                'curso_id' => 1
            ],
            [
                'nome' => 'Categoria B',
                'max_horas' => 30,
                'curso_id' => 2
            ],
            [
                'nome' => 'Categoria C',
                'max_horas' => 40,
                'curso_id' => 3
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }

        $turmas = [
            [
                'ano' => 2005,
                'curso_id' => 1
            ],
            [
                'ano' => 2010,
                'curso_id' => 2
            ],
            [
                'ano' => 2015,
                'curso_id' => 3
            ],
        ];

        foreach ($turmas as $turma) {
            Turma::create($turma);
        }


        $alunos = [
            [
                'nome' => 'Carol',
                'cpf' => '12345678900',
                'email' => 'carol@gmail.com',
                'senha' => bcrypt('12345678'),
                'turma_id' => 1,
                'curso_id' => 1
            ],
            [
                'nome' => 'João',
                'cpf' => '98765432100',
                'email' => 'joao@gmail.com',
                'senha' => bcrypt('87654321'),
                'turma_id' => 1,
                'curso_id' => 1
            ],
            [
                'nome' => 'Maria',
                'cpf' => '45678912300',
                'email' => 'maria@gmail.com',
                'senha' => bcrypt('123123123'),
                'turma_id' => 2,
                'curso_id' => 2
            ],
            [
                'nome' => 'Pedro',
                'cpf' => '32165498700',
                'email' => 'pedro@gmail.com',
                'senha' => bcrypt('321321321'),
                'turma_id' => 2,
                'curso_id' => 2
            ],
            [
                'nome' => 'Ana',
                'cpf' => '78912345600',
                'email' => 'ana@gmail.com',
                'senha' => bcrypt('456456456'),
                'turma_id' => 3,
                'curso_id' => 3
            ],
        ];


        foreach ($alunos as $aluno) {
            Aluno::create($aluno);
        }

        $documentos = [
            [
                'url' => 'https://example.com/rg.pdf',
                'descricao' => 'Documento de Identidade',
                'horas_in' => 0,
                'status' => 'pendente',
                'comentario' => 'Aguardando aprovação',
                'horas_out' => 0,
                'categoria_id' => 1
            ],
            [
                'url' => 'https://example.com/cpf.pdf',
                'descricao' => 'Cadastro de Pessoa Física',
                'horas_in' => 0,
                'status' => 'pendente',
                'comentario' => 'Aguardando aprovação',
                'horas_out' => 0,
                'categoria_id' => 2
            ],
            [
                'url' => 'https://example.com/certidao.pdf',
                'descricao' => 'Certidão de Nascimento',
                'horas_in' => 0,
                'status' => 'pendente',
                'comentario' => 'Aguardando aprovação',
                'horas_out' => 0,
                'categoria_id' => 3
            ],
        ];

        foreach ($documentos as $documento) {
            Documento::create($documento);
        }

        $comprovantes = [
            [
                'horas' => 10,
                'atividade' => 'Atividade 1',
                'categoria_id' => 1,
                'aluno_id' => 1
            ],
            [
                'horas' => 15,
                'atividade' => 'Atividade 2',
                'categoria_id' => 2,
                'aluno_id' => 2
            ],
            [
                'horas' => 20,
                'atividade' => 'Atividade 3',
                'categoria_id' => 3,
                'aluno_id' => 3
            ],
        ];

        foreach ($comprovantes as $comprovante) {
            Comprovante::create($comprovante);
        }

        $declaracoes = [
            [
                'hash' => 'abc123',
                'data' => '2023-01-01',
                'aluno_id' => 1,
                'comprovante_id' => 1
            ],
            [
                'hash' => 'def456',
                'data' => '2023-02-01',
                'aluno_id' => 2,
                'comprovante_id' => 2
            ],
            [
                'hash' => 'ghi789',
                'data' => '2023-03-01',
                'aluno_id' => 3,
                'comprovante_id' => 3
            ],
        ];

        foreach ($declaracoes as $declaracao) {
            Declaracao::create($declaracao);
        }
    }
}