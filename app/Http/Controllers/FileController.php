<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\File;
use App\Models\Tag;
use App\Services\FileService;
use App\Http\Requests\StoreFileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $approvedFiles = File::where('status', 'approved')->with('tags')->with('advisor')->with('owner')->get();
        
        $tags = Tag::all();

        return view('project.index', compact('approvedFiles', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $advisors = User::where('role', 'teacher')->get();

        $tags = Tag::all();

        return view('project.create', compact('advisors', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'advisor_id' => 'required|exists:users,id',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $ownerId = auth()->id();

        $tags = $request->input('tags');

        try {
            $file = $this->fileService->storeFile($request->file('file'), $ownerId, $request->input('advisor_id'));
            $file->tags()->attach($tags);
        } catch (\Exception $e) {
            return back()->withErrors(['file' => 'O arquivo deve ser um tipo de arquivo válido.'])->withInput();
        }

        return redirect()->route('project.show', $ownerId)->with('success', 'Arquivo enviado com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $userId)
    {
        $approvedFiles = File::where('owner_id', $userId)->where('status', 'approved')->with('tags')->with('advisor')->get();
        $pendingFiles  = File::where('owner_id', $userId)->where('status', 'pending' )->with('tags')->with('advisor')->get();
        $refusedFiles  = File::where('owner_id', $userId)->where('status', 'refused' )->with('tags')->with('advisor')->get();

        $tags = Tag::all();

        return view('project.show', compact('userId', 'approvedFiles', 'pendingFiles', 'refusedFiles', 'tags'));
    }

    public function download($id)
    {
        $file = File::findOrFail($id);

        // Verifica se o arquivo existe no storage
        if (Storage::disk('new')->exists($file->name)) {
            return Storage::disk('new')->download($file->name, $file->old_name);
        } else {
            // Lida com o caso em que o arquivo não existe
            abort(404, 'Arquivo não encontrado');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
