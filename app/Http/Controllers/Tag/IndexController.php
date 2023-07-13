<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        // Тут мы получаем только те, что принадлежат текущему пользователю.
        $tags = auth()->user()->tags;

        // Выводим представление со списком тегов, передавая коллекцию тегов в этот вид.
        return view('tags.index', compact('tags'));
    }
}
