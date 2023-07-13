<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function edit(string $id)
    {
        // Ищем тег в базе данных. Если тег не найден, Laravel автоматически выбросит исключение ModelNotFoundException
        $tag = Tag::findOrFail($id);

        // Проверяем, имеет ли текущий аутентифицированный пользователь право на редактирование этого тега
        // Если пользователь, который пытается редактировать тег, не является его владельцем, то мы перенаправляем его обратно на страницу со списком тегов с сообщением об ошибке
        if ($tag->user_id !== auth()->id()) {
            return redirect()->route('tags.index')
                ->with('error', 'Вы не можете редактировать этот тег.');
        }

        // Выводим представление редактирования тега с передачей данных о теге в этот вид
        return view('tags.edit', compact('tag'));
    }
}
