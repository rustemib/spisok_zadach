<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use App\Helpers\ImageHelper;


class UpdateController extends Controller
{
    public function update(UpdateRequest $request, Task $task)
    {
        // Валидация входных данных.
        $request->validated();

        // Обновление полей объекта задачи.
        $task->title = $request->title;
        $task->description = $request->description;

        // Сохранение задачи в базе данных.
        $task->save();

        // Получение массива ID тегов.
        $tags = $request->tags;

        // Синхронизация тегов задачи с переданными тегами.
        $task->tags()->sync($tags);

        // Если был загружен новый файл изображения, сохранить его и обновить путь к изображению для задачи.
        if ($request->hasFile('image')) {
            $task->image_path = ImageHelper::saveImage($request->file('image'));
        }

        // Перенаправление на страницу задачи с сообщением об успешном обновлении.
        return redirect()->route('tasks.show', $task)->with('success', 'Tasks updated successfully.');
    }
}
