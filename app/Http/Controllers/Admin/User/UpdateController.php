<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{
    public function update(Request $request, $id)
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
}
