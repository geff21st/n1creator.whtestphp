<?php

namespace App\Observers;

use App\Models\ToDoList;
use App\Services\StringService;

class ToDoListObserver
{
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
        foreach ($toDoList->getAttributes() as $key => $value) {
            $newKey = StringService::snakeToCamelCase($key);
            // Если ключ атрибута не содержит "_", пропускаем атрибут
            if ($newKey === $key) {
                continue;
            }

            $toDoList->setAttribute($newKey, $value);
            unset($toDoList->{$key});
        }
    }

    /**
     * Handle the ToDoList "saving" event.
     *
     * Производим обратную трансляцию имен столбцов перед сохранением объекта в БД.
     *
     * @param ToDoList $toDoList
     *
     * @return void
     */
    public function saving(ToDoList $toDoList)
    {
        foreach ($toDoList->getAttributes() as $key => $value) {
            $newKey = StringService::camelCaseToSnake($key);
            // Если ключ атрибута не изменился, пропускаем атрибут
            if ($newKey === $key) {
                continue;
            }

            $toDoList->setAttribute($newKey, $value);
            unset($toDoList->{$key});
        }
    }

}
