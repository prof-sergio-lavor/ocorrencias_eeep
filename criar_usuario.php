<?php

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Database\Capsule\Manager as Capsule;

$app = require __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Insere um usuário de teste com senha 123456
DB::table('usuarios')->insert([
    'nome' => 'Administrador',
    'email' => 'admin@eeep.com',
    'senha' => Hash::make('123456'),
    'telefone' => '889999999',
    'tipo' => 'administrador',
    'foto' => null,
    'created_at' => now(),
    'updated_at' => now()
]);

echo "✅ Usuário criado com sucesso!";
