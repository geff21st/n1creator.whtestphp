<?php

namespace Database\Factories;

use App\Models\ToDoList;
use Illuminate\Database\Eloquent\Factories\Factory;

class ToDoListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ToDoList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'test'                  => \Str::random(10),
            'group_name'            => \Str::random(11),
            'file_name'             => \Str::random(12),
            'example_name'          => \Str::random(11),
            'multiple_words_column' => \Str::random(10),
        ];
    }
}
