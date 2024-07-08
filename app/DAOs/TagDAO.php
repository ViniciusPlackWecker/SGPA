<?php

namespace App\DAOs;

use App\Models\Tag;
use App\DTO\TagDTO;
use Illuminate\Support\Collection;

class TagDAO
{
    public function getAllTags(): Collection
    {
        $tags = Tag::all();
        
        return $tags->map(function ($tag) {
            return new TagDTO(
                $tag->id,
                $tag->name
            );
        });
    }

    public function findTagById(int $id)
    {
        return Tag::findOrFail($id);
    }

    public function createTag(array $data)
    {
        return Tag::create($data);
    }

    public function updateTag(Tag $tag, array $data)
    {
        $tag->update($data);
    }

    public function deleteTag(Tag $tag)
    {
        $tag->delete();
    }
}