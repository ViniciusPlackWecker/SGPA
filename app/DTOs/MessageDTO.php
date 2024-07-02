<?php

namespace App\DTOs;

class MessageDTO
{
    public ?int $id;
    public string $topic;
    public string $description;
    public int $sender_id;
    public int $receiver_id;

    public function __construct(?int $id, string $topic, string $description, int $sender_id, int $receiver_id)
    {
        $this->id = $id;
        $this->topic = $topic;
        $this->description = $description;
        $this->sender_id = $sender_id;
        $this->receiver_id = $receiver_id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'topic' => $this->topic,
            'description' => $this->description,
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
        ];
    }
}