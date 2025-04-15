<?php

namespace App\Console\Commands;

use H2Connection;
use Illuminate\Console\Command;

class InitH2Database extends Command
{
    protected $signature = 'h2:init';
    protected $description = 'Inicindo H2 DataBase';

    public function handle(){
        $h2 = new H2Connection();
        $connecte = $h2->getConnection();        
        $connecte->exec(file_get_contents(database_path('migrations/h2_shema.sql')));

        $this->info('H2 database iniciado com sucesso!');
    }
}
