<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        // Получаем всех пользователей, задачи и теги из базы данных
        $users = User::all();
        $tasks = Task::all();
        $tags = Tag::all();

        // Возвращаем представление (view) админской главной страницы,
        // передавая туда информацию о пользователях, задачах и тегах
        return view('admin.index', compact('users', 'tasks', 'tags'));
    }
}
