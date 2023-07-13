<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        // Получаем параметр 'search' из запроса, который используется для поиска задачи по названию
        $search = $request->get('search');

        // Получаем параметр 'tag_ids' из запроса, который содержит ID тегов для фильтрации задач
        $tag_ids = $request->get('tag_ids');

        // Создаем новый экземпляр запроса к базе данных
        $tasks = Task::query()
            // Фильтруем задачи, принадлежащие текущему пользователю
            ->where('user_id', Auth::id())
            // Если параметр 'search' не пуст, добавляем условие в запрос для поиска задач по названию
            ->when($search, function ($query) use ($search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            // Если параметр 'tag_ids' не пуст, добавляем условие в запрос для фильтрации задач по тегам
            ->when($tag_ids, function ($query) use ($tag_ids) {
                return $query->whereHas('tags', function($query) use ($tag_ids) {
                    return $query->whereIn('tags.id', $tag_ids);
                });
            })
            // Включаем в результат запроса связанные данные по тегам и пользователям
            ->with('tags', 'user')
            // Получаем результаты запроса
            ->get();

        // Получаем все теги текущего пользователя
        $tags = auth()->user()->tags;

        // Возвращаем представление с задачами и тегами
        return view('layouts.index', compact('tasks', 'tags'));
    }
}
