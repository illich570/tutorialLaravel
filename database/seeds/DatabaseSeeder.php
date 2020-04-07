<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
          'users',
          'posts',
          'comments'
        ]);
        $this->call(UsersTableSeeder::class);
        $this->call(PostSeeder::class);
    }


    public function truncateTables(array $tables){
      DB::statement("SET session_replication_role = 'replica';");

      foreach($tables as $table){
        DB::table($table)->truncate();
      }

      DB::statement("SET session_replication_role = 'origin';");
    }
}
