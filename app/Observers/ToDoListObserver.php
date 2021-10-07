<?php

namespace App\Observers;

use App\Models\ToDoList;
use App\Services\StringService;

class ToDoListObserver
{
    /**
     * @param ToDoList $toDoList
     * @param callable $converter
     */
    private function convertColumnNames(ToDoList $toDoList, callable $converter)
    {
        foreach ($toDoList->getAttributes() as $key => $value) {
            $newKey = $converter($key);
            // Если ключ атрибута не изменился, пропускаем атрибут
            if ($newKey === $key) {
                continue;
            }

            $toDoList->setAttribute($newKey, $value);
            unset($toDoList->{$key});
        }
    }

    /**
     * Handle the ToDoList "retrieved" event.
     *
     * Производит трансляцию имен столбцов из БД в модель в camelCase,
     * например group_name -> groupName, file_name -> fileName.
     *
     * По итогу, мы должны обращаться к свойствам модели в camelCase, например:
     * $media->fileName,
     * $role->groupName.
     *
     * @param ToDoList $toDoList
     *
     * @return void
     */
    public function retrieved(ToDoList $toDoList)
    {
        $this->convertColumnNames(
            $toDoList,
            [StringService::class, 'snakeToCamelCase']
        );
    }

    /**
     * Handle the ToDoList "saving" event.
     *
     * Производим обратную трансляцию имен столбцов
     * перед сохранением объекта в БД.
     *
     * @param ToDoList $toDoList
     *
     * @return void
     */
    public function saving(ToDoList $toDoList)
    {
        $this->convertColumnNames(
            $toDoList,
            [StringService::class, 'camelCaseToSnake']
        );
    }

}
