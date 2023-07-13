<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        // Получаем все задачи из базы данных с отношениями 'user' и 'tags'
        $tasks = Task::with('user', 'tags')->get();

        // Возвращаем представление и передаем в него данные о всех задачах
        return view('admin.tasks', compact('tasks'));
    }
}
