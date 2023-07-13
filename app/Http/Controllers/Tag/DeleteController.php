<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function destroy(string $id)
    {
        // Ищем тег в базе данных. Если тег не найден, Laravel автоматически выбросит исключение ModelNotFoundException
        $tag = Tag::findOrFail($id);

        // Проверяем, имеет ли текущий аутентифицированный пользователь право на удаление этого тега
        // Если пользователь, который пытается удалить тег, не является его владельцем, то мы перенаправляем его обратно на страницу со списком тегов с сообщением об ошибке
        if ($tag->user_id !== auth()->id()) {
            return redirect()->route('tags.index')
                ->with('error', 'Вы не можете удалить этот тег.');
        }

        // Удаляем тег из базы данных
        $tag->delete();

        // Перенаправляем пользователя обратно на страницу со списком тегов с сообщением об успешном удалении тега
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully');
    }
}
