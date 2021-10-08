<?php

namespace Tests\Feature;

use App\Models\ToDoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ToDoListTest extends TestCase
{
    public function test_column_case_conversion()
    {
        $row = ToDoList::first();

        $this->assertTrue(!empty($row->exampleName));
    }

    public function test_column_case_save()
    {
        $newTestValue = 'test_example123';

        $row = ToDoList::first();

        $row->exampleName = $newTestValue;
        $row->save();

        $row = ToDoList::first();

        $this->assertTrue($row->exampleName == $newTestValue);
    }
}
