<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //тут реализован поисковик и фильтр
        $search = $request->get('search');// получаем параметр search (поиск по назанию)
        $tag_ids = $request->get('tag_ids'); // получаем праметр тега
        //делаем запрос в базу
        $tasks = Task::query()
            //задачи только принадлежащие авторизованному пользователю
            ->where('user_id', Auth::id())
            //тут добавление условия, если $search не пустой, то будет выполена функция function
            ->when($search, function ($query) use ($search) {
                //возвращает совпадение тайтл
                return $query->where('title', 'like', "%{$search}%");
            })
            //если тагайди не пустой то выполняется функция
            ->when($tag_ids, function ($query) use ($tag_ids) {

                return $query->whereHas('tags', function($query) use ($tag_ids) {
                    return $query->whereIn('tags.id', $tag_ids);
                });
            })
            ->with('tags', 'user')
            ->get();
        //прверка принадлежности тега пользователю
        $tags = auth()->user()->tags;
//        dd($tags);
        return view('layouts.index', compact('tasks', 'tags'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        $tags = Tag::all();
        //прверка принадлежности тега пользователю
        $tags = auth()->user()->tags;
        return view('layouts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            //получаем данные с формы и проходим валидацию
            $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'tags' => 'nullable|array',
                'image' => 'nullable|image|max:2048',
            ]);
            //создаем экзепляр класса таск
            $task = new Task;
            //записываем адишник автора
            $task->user_id = Auth::id();
            //записываем тайтл
            $task->title = $request->title;
            // записываем описание
            $task->description = $request->description;
            //дальше картинка, если прошла валидацию  'image' => 'nullable|image|max:2048', то
            //присваеваем имя картинка время (уникальное имя) и расширение файла.
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                //создаем путь к картинке, тут используется библиотека Intervention Image (для манипуляций с картинкой).
                $location = public_path('images/' . $filename);
                $img = Image::make($image);
                $img->save($location);

                $task->image_path = '/' . $filename;
            }
            $task->save();

            $tags = $request->tags;
            //связывем модели таск и таг (attach добавить)
            $task->tags()->attach($tags);

            return redirect()->route('tasks.index');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {

        return view('layouts.show', compact('task'));
    }

    public function edit(Task $task)
    {
        //тут проверка является ли пользователь автором таска, это если всем виден таск
//        if(Auth::id() !== $task->user_id) {
//            abort(403, 'Unauthorized action.');
//        }
//        $tags = Tag::all();

        //прверка принадлежности тега пользователю
        $tags = auth()->user()->tags;

        return view('layouts.edit', compact('task', 'tags'));
    }

    public function update(Request $request, Task $task)
    {
        //тут проверка является ли пользователь автором таска, это если всем виден таск
//        if(Auth::id() !== $task->user_id) {
//            abort(403, 'Unauthorized action.');
//        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);


        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();
        $tags = $request->tags;
        $task->tags()->sync($tags);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            $img = Image::make($image);
            $img->save($location);
            $task->image_path = '/' . $filename;
            $task->save();
        }

        return redirect()->route('tasks.show', $task)->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        //тут проверка является ли пользователь автором таска, это если всем виден таск
//        if(Auth::id() !== $task->user_id) {
//            abort(403, 'Unauthorized action.');
//        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task удален.');
    }
}
