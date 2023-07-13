<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
        //Метод для отображения страницы со всеми тегами.
class IndexController extends Controller
{
    public function index()
    {
        // Используем Eloquent ORM для получения всех тегов из базы данных.
        $tags = Tag::all();

        // Возвращаем представление 'admin.tags', передавая туда массив всех тегов.
        // Функция compact создает массив, содержащий переменные и их значения.
        return view('admin.tags', compact('tags'));
    }
}
