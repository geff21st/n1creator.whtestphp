<?php

namespace Database\Seeders;

use App\Models\ToDoList;
use Illuminate\Database\Seeder;

class ToDoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ToDoList::factory()
            ->count(20)
            ->create();
    }
}
