<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use App\Services\StringService;

class CamelCaseFieldsObserver
{
    /**
     * @param Model $modelRow
     * @param callable $converter
     */
    private function convertColumnNames(Model $modelRow, callable $converter)
    {
        foreach ($modelRow->getAttributes() as $key => $value) {
            $newKey = $converter($key);
            // Если ключ атрибута не изменился, пропускаем атрибут
            if ($newKey === $key) {
                continue;
            }

            $modelRow->setAttribute($newKey, $value);
            unset($modelRow->{$key});
        }
    }

    /**
     * Handle the Model "retrieved" event.
     *
     * Производит трансляцию имен столбцов из БД в модель в camelCase,
     * например group_name -> groupName, file_name -> fileName.
     *
     * По итогу, мы должны обращаться к свойствам модели в camelCase, например:
     * $media->fileName,
     * $role->groupName.
     *
     * @param Model $modelRow
     *
     * @return void
     */
    public function retrieved(Model $modelRow)
    {
        $this->convertColumnNames(
            $modelRow,
            [StringService::class, 'snakeToCamelCase']
        );
    }

    /**
     * Handle the Model "saving" event.
     *
     * Производим обратную трансляцию имен столбцов
     * перед сохранением объекта в БД.
     *
     * @param Model $modelRow
     *
     * @return void
     */
    public function saving(Model $modelRow)
    {
        $this->convertColumnNames(
            $modelRow,
            [StringService::class, 'camelCaseToSnake']
        );
    }
}
