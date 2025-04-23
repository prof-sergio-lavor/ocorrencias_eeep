<?php

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Atualiza a senha do admin para '123456'
DB::table('usuarios')
    ->where('email', 'admin@eeep.com')
    ->update(['senha' => Hash::make('123456')]);

echo "✅ Senha atualizada com sucesso!";
    