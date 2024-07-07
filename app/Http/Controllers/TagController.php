<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index() {
        $tags = Tag::all();
        return view('tag.index', compact('tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Verificar se o nome já existe (exceto a tag atual)
        $existingTag = Tag::where('name', $request->name)->where('id', '!=', $id)->first();
        if ($existingTag) {
            return redirect()->back()->withErrors(['name' => 'Essa tag já existe.'])->withInput();
        }

        $tag = Tag::findOrFail($id);
        $tag->name = $request->name;
        $tag->save();

        return redirect()->back()->with('success', 'Tag atualizada com sucesso');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->back()->with('success', 'Tag excluída com sucesso');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        // Verificar se o nome já existe
        $existingTag = Tag::where('name', $request->name)->first();
        if ($existingTag) {
            return redirect()->back()->withErrors(['name' => 'Essa tag já existe.'])->withInput();
        }

        Tag::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Tag criada com sucesso');
    }
}
