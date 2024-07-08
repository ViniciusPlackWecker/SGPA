<?php

namespace App\Services;

use App\DAOs\TagDAO;
use App\DTOs\TagDTO;
use Illuminate\Support\Collection;

class TagService
{
    protected TagDAO $tagDAO;

    public function __construct(TagDAO $tagDAO)
    {
        $this->tagDAO = $tagDAO;
    }

    public function getAllTags(): Collection
    {
        return $this->tagDAO->getAllTags();
    }

    public function createTag(array $data): TagDTO
    {
        $tag = $this->tagDAO->createTag($data);
        return new TagDTO($tag->id, $tag->name);
    }

    public function updateTag(int $id, array $data): TagDTO
    {
        $tag = $this->tagDAO->findTagById($id);
        $this->tagDAO->updateTag($tag, $data);
        return new TagDTO($tag->id, $tag->name);
    }

    public function deleteTag(int $id): void
    {
        $tag = $this->tagDAO->findTagById($id);
        $this->tagDAO->deleteTag($tag);
    }
}