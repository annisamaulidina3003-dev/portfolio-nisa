<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(Request $request): View
    {
        $categories = config('portfolio.feedback_categories');
        $category = $request->string('category')->value();

        $messages = Message::query()
            ->when(in_array($category, $categories, true), fn ($query) => $query->where('category', $category))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.messages.index', compact('messages', 'categories', 'category'));
    }

    public function show(Message $message): View
    {
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
