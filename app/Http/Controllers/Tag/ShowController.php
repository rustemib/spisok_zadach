<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function show(string $id)
    {
        // Находим тег по его ID с помощью метода findOrFail(), который выбросит исключение,
        // если тег с таким ID не будет найден.
        $tag = Tag::findOrFail($id);

        // Отправляем тег в представление, чтобы его можно было отобразить.
        return view('tags.show', compact('tag'));
    }
}
