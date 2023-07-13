<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function store(StoreRequest $request)
    {
        // Проверяем, что все данные в запросе прошли валидацию. Если какие-то данные не прошли валидацию,
        // будет выброшено исключение ValidationException, и пользователь будет перенаправлен обратно.
        $request->validated();

        // Создаем новый экземпляр модели Tag.
        $tag = new Tag;

        // Устанавливаем имя тега из запроса.
        $tag->name = $request->name;

        // Устанавливаем ID пользователя, создавшего тег, как текущий аутентифицированный пользователь.
        $tag->user_id = auth()->id();

        // Сохраняем тег в базе данных.
        $tag->save();

        // Перенаправляем пользователя на страницу со списком тегов с сообщением об успехе.
        return redirect()->route('tags.index')->with('success', 'Тег сохранен.');
    }
}
