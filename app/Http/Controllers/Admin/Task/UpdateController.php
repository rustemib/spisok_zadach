<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use App\Helpers\ImageHelper;

class UpdateController extends Controller
{
    public function update(UpdateRequest $request, $id)
    {
        // Ищем задачу в базе данных по id
        $task = Task::findOrFail($id);

        // Валидация данных из запроса
        $request->validated();

        // Обновляем данные задачи
        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        // Обновляем связанные теги
        $tags = $request->tags;
        $task->tags()->sync($tags);

        // Если представлен новый файл изображения, сохраняем его и обновляем путь к изображению в базе данных
        if ($request->hasFile('image')) {
            $task->image_path = ImageHelper::saveImage($request->file('image'));
        }
        // Перенаправляем пользователя на страницу со списком задач
        return redirect()->route('admin.tasks');
    }
}
