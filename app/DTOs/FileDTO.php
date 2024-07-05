<?php

namespace App\DTOs;

class FileDTO
{
    public $id;
    public $name;
    public $old_name;
    public $owner_id;
    public $advisor_id;
    public $status;

    public function __construct($name, $old_name, $owner_id, $advisor_id, $status)
    {
        $this->name = $name;
        $this->old_name = $old_name;
        $this->owner_id = $owner_id;
        $this->advisor_id = $advisor_id;
        $this->status = $status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'old_name' => $this->old_name,
            'owner_id' => $this->owner_id,
            'advisor_id' => $this->advisor_id,
            'status' => $this->status,
        ];
    }
}