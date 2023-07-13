<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function create()
    {
        // Получение всех тегов, принадлежащих текущему аутентифицированному пользователю.
        $tags = auth()->user()->tags;

        // Возвращаем представлени, которое содержит форму для создания нового ресурса.
        // Мы также передаём теги этого пользователя представление, чтобы они могли быть использованы для отображения списка тегов.
        return view('layouts.create', compact('tags'));
    }
}
