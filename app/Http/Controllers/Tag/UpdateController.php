<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\UpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function update(UpdateRequest $request, string $id)
    {
        // Проверяем, что все данные в запросе прошли валидацию. Если какие-то данные не прошли валидацию,
        // будет выброшено исключение ValidationException, и пользователь будет перенаправлен обратно.
        $request->validated();

        // Ищем тег в базе данных по ID. Если тег не найден, будет выброшено исключение ModelNotFoundException.
        $tag = Tag::findOrFail($id);

        // Проверяем, является ли текущий аутентифицированный пользователь владельцем тега.
        // Если нет, перенаправляем его обратно с сообщением об ошибке.
        if ($tag->user_id !== auth()->id()) {
            return redirect()->route('tags.index')
                ->with('error', 'Вы не можете обновлять этот тег.');
        }

        // Обновляем имя тега из запроса.
        $tag->name = $request->name;

        // Сохраняем изменения в базе данных.
        $tag->save();

        // Перенаправляем пользователя на страницу со списком тегов с сообщением об успехе.
        return redirect()->route('tags.index')->with('success', 'Tag updated successfully');
    }
}
