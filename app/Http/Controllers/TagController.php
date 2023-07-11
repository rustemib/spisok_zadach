<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $tags = Tag::all();
        // проверка на принадлежность тегоа к пользователю
        $tags = auth()->user()->tags;
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:tags']);
        $tag = new Tag;
        $tag->name = $request->name;
        //сохраняет айдишку пользователя
        $tag->user_id = auth()->id();
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Тег сохранен.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::findOrFail($id);

        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::findOrFail($id);
        // если включить отображение всех тегов всех пользователей то это условие не даст редактировать теги других
        if ($tag->user_id !== auth()->id()) {
            return redirect()->route('tags.index')
                ->with('error', 'Вы не можете редактировать этот тег.');
        }

        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Валидация входных данных
        $request->validate([
            'name' => 'required|max:255',
        ]);

        // Найти тег по айдишнику и обновить его
        $tag = Tag::findOrFail($id);
        //тут тоже самое что и при стор
        if ($tag->user_id !== auth()->id()) {
            return redirect()->route('tags.index')
                ->with('error', 'Вы не можете обновлять этот тег.');
        }
        $tag->name = $request->name;
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //найти по айди и удалить
        $tag = Tag::findOrFail($id);
        //та же проверка что и выше
        if ($tag->user_id !== auth()->id()) {
            return redirect()->route('tags.index')
                ->with('error', 'Вы не можете удалить этот тег.');
        }
        $tag->delete();


        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully');
    }

}
