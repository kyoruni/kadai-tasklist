<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 50; $i++) {
           DB::table('tasks')->insert([
                'status'   => 'status'  . $i,
                'content'  => 'test content' . $i,
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")]);
        }
    }
}
