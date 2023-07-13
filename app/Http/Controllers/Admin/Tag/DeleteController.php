<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    //Удаление тега
    public function destroy($id)
    {
        // Находим тег по переданному ID. Если тег не найден, будет выброшено исключение ModelNotFoundException
        $tag = Tag::findOrFail($id);

        // Удаляем тег из базы данных
        $tag->delete();

        // Перенаправляем пользователя на страницу со всеми тегами
        return redirect()->route('admin.tags');
    }
}
