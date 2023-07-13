<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function edit($id)
    {
        // Находим задачу по переданному ID. Если задача не найдена, будет выброшено исключение ModelNotFoundException
        $task = Task::findOrFail($id);

        // Получаем все теги из базы данных
        $tags = Tag::all();

        // Возвращаем представление и передаем в него данные о задаче и все теги
        return view('admin.edit_task', compact('task', 'tags'));
    }
}
