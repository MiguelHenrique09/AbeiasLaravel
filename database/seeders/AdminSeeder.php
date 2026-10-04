<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = $this->command->ask('E-mail do administrador', 'admin@abeias.com');
        $senha = $this->command->secret('Senha do administrador (mínimo 8 caracteres)');

        if (! $senha || strlen($senha) < 8) {
            $this->command->error('Senha inválida. Nenhum administrador foi criado.');

            return;
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'nome' => 'Administrador',
                'password' => Hash::make($senha),
                'tipo_usuario' => 'Administrador',
            ]
        );
    }
}
