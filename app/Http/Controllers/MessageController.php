<?php

namespace App\Http\Controllers;

use App\DTOs\MessageDTO;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index(): View
    {
        $userId = auth()->id();
        $conversations = $this->messageService->getAllConversations($userId);

    
        foreach ($conversations as $conversation) {
            $topicParts = explode('-', $conversation->topic, 3);
            $conversation->cleanTopic = isset($topicParts[2]) ? $topicParts[2] : $conversation->topic;
    }

    return view('messages.index', compact('conversations', 'userId'));
    }

    public function show(string $topic): View
    {

        $userId = auth()->id();

        $messages = $this->messageService->getMessagesInTopic($topic, $userId);
    
        $otherUserId = $messages->isEmpty() ? null :
            ($messages->first()->sender_id === $userId ? $messages->first()->receiver_id : $messages->first()->sender_id);
    
        $otherUser = $otherUserId ? User::findOrFail($otherUserId) : null;
    
        $specificUserMessages = null;
        if ($otherUserId) {
            $specificUserMessages = $this->messageService->getMessagesBetweenUsersInTopic($topic, $userId, $otherUserId);
        }

        foreach ($specificUserMessages as $specificUserMessage) {
            $topicParts = explode('-', $specificUserMessage->topic, 3);
            $specificUserMessage->cleanTopic = isset($topicParts[2]) ? $topicParts[2] : $specificUserMessage->topic;
        }

        return view('messages.show', [
            'topic' => $topic,
            'messages' => $messages,
            'otherUser' => $otherUser,
            'specificUserMessages' => $specificUserMessages,
        ]);
    }

    public function createWithReceiver($receiver_id): View
    {
        $user = User::findOrFail($receiver_id);

        return view('messages.create', [
            'receiver_id'    => $user->id,
            'receiver_email' => $user->email,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $senderId = Auth::id();
            $receiverId = $request->input('receiver_id');
            $topic = "{$senderId}-{$receiverId}-" . $request->input('topic'); 
    
            $messageDTO = new MessageDTO(
                null,
                $topic,
                $request->input('description'),
                $senderId, 
                $receiverId
            );
    
            $message = $this->messageService->createMessage($messageDTO);
    
            return redirect()->route('messages.index', $message->id)->with('success', 'Mensagem enviada com sucesso');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function storeInTopic(Request $request): RedirectResponse
    {
        try {
            $messageDTO = new MessageDTO(
                null,
                $request->input('topic'),
                $request->input('description'),
                Auth::id(),
                $request->input('receiver_id')
            );

            $message = $this->messageService->createMessage($messageDTO);

            return redirect()->back()->with('success', 'Mensagem enviada com sucesso');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}
