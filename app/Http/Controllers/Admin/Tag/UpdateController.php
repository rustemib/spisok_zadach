<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\UpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function update(UpdateRequest $request, $id)
    {
        // Находим тег по переданному ID. Если тег не найден, будет выброшено исключение ModelNotFoundException
        $tag = Tag::findOrFail($id);

        // Проверяем валидность данных в запросе. В случае успеха выполнение кода продолжится, иначе будет выброшено исключение ValidationException
        $request->validated();

        // Обновляем имя тега
        $tag->name = $request->name;

        // Сохраняем обновленные данные тега в базе данных
        $tag->save();

        // Перенаправляем пользователя на страницу со всеми тегами
        return redirect()->route('admin.tags');
    }
}
