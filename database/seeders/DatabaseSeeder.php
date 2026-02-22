<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Equipa - Ta Reservado',
            'email' => 'suporte@tareservado.pt',
            'photo_url' => 'https://picsum.photos/500/500',
            'bio' => 'Porque o seu tempo é importante !',
        ]);
    }
}
