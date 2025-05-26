erro 09;31 26/05/2025 
Vite manifest not found at: C:\Users\Aluno\Downloads\sigac-trabalho-semestral-YASMIMRM06\projeto\public\build/manifest.json
captura de tela 5
------------

Para iniciar um projeto Laravel e trabalhar com o php artisan, siga estes passos:

 Criar um novo projeto Laravel
Abra o terminal e execute:

composer create-project laravel/laravel nome-do-projeto
Depois, entre na pasta do projeto:

cd nome-do-projeto
Subir o servidor local com Artisan
Artisan é a interface de linha de comando do Laravel. Para iniciar o servidor de desenvolvimento:

php artisan serve
Acesse no navegador: http://localhost:8000

Criar arquivos com Artisan:
Criar um Controller:
php artisan make:controller NomeDoController
Criar um Model:
php artisan make:model NomeDoModel
Criar uma Migration:
php artisan make:migration create_nome_da_tabela_table
Rodar migrations:
php artisan migrate
Criar um Seeder:
php artisan make:seeder NomeDoSeeder
Popular banco com Seeders:
php artisan db:seed
✅ Dica extra: .env
O arquivo .env contém as configurações do ambiente (como o banco de dados). Exemplo:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=root
DB_PASSWORD=sua_senha


🔧 PASSOS PARA ATUALIZAR O PHP NO WINDOWS (usando XAMPP):
✔️ 1. Verifique a versão atual do PHP:
No terminal:

php -v
Você verá algo como:

PHP 8.1.10 (cli) ...


composer install
Depois:

php artisan serve
