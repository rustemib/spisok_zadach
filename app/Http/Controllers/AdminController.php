<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    //в админку передаем юзеров. задачи и теги
    public function index(){

        $users = User::all();
        $tasks = Task::all();
        $tags = Tag::all();
        return view('admin.index', compact('users', 'tasks', 'tags'));
}

    // Получить список всех пользователей
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // Получить список всех задач
    public function tasks()
    {
        $tasks = Task::with('user', 'tags')->get();

        return view('admin.tasks', compact('tasks'));
    }

    // Редактировать задачу
    public function editTask($id)
    {
        //находит по йди
        $task = Task::findOrFail($id);
        $tags = Tag::all();
        return view('admin.edit_task', compact('task', 'tags'));
    }

    // Обновить задачу
    public function updateTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);

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

        return redirect()->route('admin.tasks');
    }

    // добавить пользователя
    public function createUser(){
        return view('admin.create_user');
    }
    public function storeUser(Request $request){
        $user = $request->validate([
            'name' => 'required|max:255',
            'email' => 'email',
            'password'=>'required|min:8',
            'is_admin' => 'boolean'
        ]);
        User::firstOrCreate($user);
        return redirect()->route('admin.users')->with('success', 'Пользователь создан');
    }
    // Редактировать пользователя
    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    // Обновить пользователя
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // Валидация данных
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:8',  // если не менять пароль то остается старый
            'is_admin' => 'boolean',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin ?? 0;
        // Если представлен новый пароль, хешируем его перед сохранением
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Обновляем пользователя
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Обновлен пользователь');
    }
    public function destroyUser($id){

        $user = User::findOrFail($id);


        // находим все задачи этого пользователя и удаляем если есть
        if ($user->tasks) {
            foreach ($user->tasks as $task) {
                $task->delete();
            }
        }

        // так же удаляем теги если есть
        if ($user->tags) {
            foreach ($user->tags as $tag) {
                $tag->delete();
            }
        }

        //удаляем пользователя
        $user->delete();
        return redirect()->route('admin.users');

    }
    //выводим список тегов в админке
    public function tags(){
        $tags = Tag::all();
        return view('admin.tags', compact('tags'));
    }


    public function editTag($id)
    {
        $tag = Tag::findOrFail($id);

        return view('admin.edit_tag', compact('tag'));
    }

    public function updateTag(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        // Валидация
        $request->validate([
            'name' => 'required|max:255',
        ]);
        // Обновление
        $tag->name = $request->name;
        $tag->save();
        // Редирект
        return redirect()->route('admin.tags');
    }
    //удалить тег
    public function destroyTag($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->route('admin.tags');
    }



}
