<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function edit($id)
    {
        // Используем Eloquent ORM для поиска тега в базе данных по ID.
        // Если тег не найден, выбрасываем исключение ModelNotFoundException,
        // которое Laravel перехватит и отобразит страницу 404.
        $tag = Tag::findOrFail($id);

        // Возвращаем представление edit_tag, передавая туда экземпляр найденного тега.
        // Функция compact создает массив, содержащий переменные и их значения.
        return view('admin.edit_tag', compact('tag'));
    }
}
