<?php

namespace App\Services;

use App\Models\Message;
use App\DTOs\MessageDTO;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MessageService
{

    public function getAllConversations(int $userId): Collection
    {
        return Message::select([
            'topic',
            'sender_id',
            'receiver_id',
        ])
        ->where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->orWhere('receiver_id', $userId);
        })
        ->groupBy('topic', 'sender_id', 'receiver_id')
        ->get();
    }

    public function getMessagesInTopic(string $topic, int $userId): Collection
    {
        // Encontrar todas as mensagens entre o usuário autenticado e qualquer outro usuário para o tópico dado
        return Message::where('topic', $topic)
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->orderBy('created_at')
            ->get();
    }

    public function getMessagesBetweenUsersInTopic(string $topic, int $userId, int $otherUserId): Collection
{
    return Message::where('topic', $topic)
        ->where(function ($query) use ($userId, $otherUserId) {
            $query->where(function ($q) use ($userId, $otherUserId) {
                $q->where('sender_id', $userId)
                  ->where('receiver_id', $otherUserId);
            })
            ->orWhere(function ($q) use ($userId, $otherUserId) {
                $q->where('sender_id', $otherUserId)
                  ->where('receiver_id', $userId);
            });
        })
        ->orderBy('created_at')
        ->get();
}

    public function createMessage(MessageDTO $messageDTO): Message
    {
        $this->validateData($messageDTO);

        $message = new Message();
        $message->topic = $messageDTO->topic;
        $message->description = $messageDTO->description;
        $message->sender_id = $messageDTO->sender_id;
        $message->receiver_id = $messageDTO->receiver_id;
        $message->save();

        return $message;
    }

    protected function validateData(MessageDTO $messageDTO)
    {
        $validator = Validator::make($messageDTO->toArray(), [
            'topic' => ['required', 'string'],
            'description' => ['required', 'string'],
            'receiver_id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function getAllMessagesByTopicAndReceiver(int $sender_id, int $receiver_id): Collection
    {
        return Message::where(function ($query) use ($sender_id, $receiver_id) {
                $query->where('sender_id', $sender_id)
                      ->where('receiver_id', $receiver_id);
        })
                      ->orWhere(function ($query) use ($sender_id, $receiver_id) {
                $query->where('sender_id', $receiver_id)
                      ->where('receiver_id', $sender_id);
        })
                      ->orderBy('created_at')
                      ->get()
                      ->map(function ($message) {
              $message->description = decrypt($message->description);
            return $message;
        });
    }
}
