<?php

use App\Models\ToDoList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/debug/editRow', function () {
    /** @var ToDoList $entityObject */
    $entityObject = ToDoList::firstOrFail();

    $entityObject->setAttribute('exampleName', 'qwerty!');
    $entityObject->save();
});

Route::get('/debug', function () {
    /** @var ToDoList $entityObject */
    $entityObject = ToDoList::firstOrFail();

    dd($entityObject);
});
