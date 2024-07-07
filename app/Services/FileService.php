<?php

namespace App\Services;

use App\Models\File;
use App\Models\Tag;
use App\DTOs\FileDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class FileService
{
    public function storeFile($file, $ownerId, $advisorId)
    {
        $originalName = $file->getClientOriginalName();
        $fileName = "{$ownerId}-{$advisorId}_" . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

        $exists = Storage::disk('new')->exists($fileName);

        if ($exists) {
            if (Storage::disk('old')->exists($fileName)) {
                Storage::disk('old')->delete($fileName);
            }
            Storage::move('Current_files/' . $fileName, 'Old_files/' . $fileName);
        }

        Storage::disk('new')->putFileAs('', $file, $fileName);

        // Criar o FileDTO com os dados necessários
        $fileDTO = new FileDTO(
            $fileName,
            $originalName,
            $ownerId,
            $advisorId,
            'pending', // Status inicial do arquivo
        );

        // Chamar o método para criar o arquivo no banco de dados
        return $this->createFile($fileDTO);
    }

    private function createFile(FileDTO $fileDTO)
    {
        return File::create([
            'name' => $fileDTO->name,
            'old_name' => $fileDTO->old_name,
            'owner_id' => $fileDTO->owner_id,
            'advisor_id' => $fileDTO->advisor_id,
            'status' => $fileDTO->status,
        ]);
    }

    public function updateStatus(string $fileStatus, int $id)
    {
        $file = File::findOrFail($id);
        $file->status = $fileStatus;

        $file->update();

        return $file;
    }

    public function updateFile($id, $request)
    {
        $request->validate([
            'advisor_id' => 'required|exists:users,id',
            'file' => 'nullable|file|mimes:pdf|max:10240',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $file = File::findOrFail($id);
        $originalFileName = $file->name;

        if ($request->hasFile('file')) {
            
            $exists = Storage::disk('new')->exists($originalFileName);

            if ($exists) {
                if (Storage::disk('old')->exists($originalFileName)) {
                    Storage::disk('old')->delete($originalFileName);
                }
                Storage::move('Current_files/' . $originalFileName, 'Old_files/' . $originalFileName);
            }

            $uploadedFile = $request->file('file');
    
            $newFileName = $originalFileName;
            $uploadedFile = Storage::disk('new')->putFileAs('', $uploadedFile, $newFileName);
        }

        $file->advisor_id = $request->input('advisor_id');
        $file->tags()->sync($request->input('tags'));
        $file->save();
    }

    public function deleteFile(int $id): void
    {
        $file = File::findOrFail($id);
        $file->delete();
    }

}
