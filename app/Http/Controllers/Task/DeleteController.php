<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function destroy(Task $task)
    {
        // Удаление задачи
        $task->delete();

        // Перенаправление пользователя на главную страницу задач с сообщением об успешном удалении задачи.
        return redirect()->route('tasks.index')->with('success', 'Tasks удален.');
    }
}
