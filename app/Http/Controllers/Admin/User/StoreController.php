<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function store(Request $request){
        $user = $request->validate([
            'name' => 'required|max:255',
            'email' => 'email',
            'password'=>'required|min:8',
            'is_admin' => 'boolean'
        ]);
        User::firstOrCreate($user);
        return redirect()->route('admin.users')->with('success', 'Пользователь создан');
    }
}
