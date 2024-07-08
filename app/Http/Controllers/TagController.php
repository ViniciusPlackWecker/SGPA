<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Services\TagService;

class TagController extends Controller
{
    protected TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
        $tags = $this->tagService->getAllTags();
        return view('tag.index', compact('tags'));
    }

    public function update(TagRequest $request, $id)
    {
        $data = $request->validated();
        $tag = $this->tagService->updateTag($id, $data);
        return redirect()->back()->with('success', 'Tag atualizada com sucesso');
    }

    public function destroy($id)
    {
        $this->tagService->deleteTag($id);
        return redirect()->back()->with('success', 'Tag excluída com sucesso');
    }

    public function store(TagRequest $request)
    {
        $data = $request->validated();
        $this->tagService->createTag($data);
        return redirect()->back()->with('success', 'Tag criada com sucesso');
    }
}