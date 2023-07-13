<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ImageHelper;

class StoreController extends Controller
{
    public function store(StoreRequest $request)
    {
        // Валидация входных данных.
        $request->validated();

        // Создание нового объекта задачи.
        $task = new Task;

        // Заполнение полей объекта задачи.
        $task->user_id = Auth::id();
        $task->title = $request->title;
        $task->description = $request->description;

        // Если был загружен файл изображения, сохранить его и установить путь к изображению для задачи.
        if ($request->hasFile('image')) {
            $task->image_path = ImageHelper::saveImage($request->file('image'));
        }

        // Сохранение задачи в базе данных.
        $task->save();

        // Получение массива ID тегов.
        $tags = $request->tags;

        // Привязка тегов к задаче.
        $task->tags()->attach($tags);

        // Перенаправление на страницу со списком задач.
        return redirect()->route('tasks.index');
    }
}
