<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function destroy($id){

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
}
