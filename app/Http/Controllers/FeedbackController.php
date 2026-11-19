<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'category' => ['required', 'string', Rule::in(config('portfolio.feedback_categories'))],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Message::create($validated);

        return redirect()
            ->to(route('home').'#kontak')
            ->with('success', 'Pesan Anda berhasil dikirim. Terima kasih atas kesan dan masukannya!');
    }
}
