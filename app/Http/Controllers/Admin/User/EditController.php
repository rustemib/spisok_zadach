<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }
}
