<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function edit(Task $task)
    {
        // Получает все теги, принадлежащие текущему авторизованному пользователю
        $tags = auth()->user()->tags;

        // Возвращается представление для редактирования задачи с двумя параметрами:
        // - 'task' - задача, которую мы хотим отредактировать
        // - 'tags' - все теги текущего пользователя, которые можно использовать для этой задачи
        return view('layouts.edit', compact('task', 'tags'));
    }
}
