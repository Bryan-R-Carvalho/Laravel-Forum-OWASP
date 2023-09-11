<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDatabaseCommand extends Command
{

    protected $signature = 'make:database';

    protected $description = 'Command description';

    public function handle()
    {
        $database = config('database.connections.pgsql.database');
        $connection = config('database.default');
        $this->info("Attempting to create database: {$database}");
        $this->info("Using connection: {$connection}");
        $exists = DB::connection($connection)->select("SELECT 1 FROM pg_database WHERE datname = '$database'");
        if (empty($exists)) {
            DB::connection($connection)->statement("CREATE DATABASE $database");
            $this->info("Database {$database} created!");
        }else{
            $this->info("Database {$database} already exists.");
        }
        

        $this->info("Creating database {$database}");
        DB::connection($connection)->statement("CREATE DATABASE IF NOT EXISTS $database");


    }
}
