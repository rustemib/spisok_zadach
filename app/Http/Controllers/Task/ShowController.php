<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function show(Task $task)
    {
        // Возвращает представление (view) 'layouts.show'
        // и передаёт в него переменную 'task', содержащую информацию о задаче
        return view('layouts.show', compact('task'));
    }
}
