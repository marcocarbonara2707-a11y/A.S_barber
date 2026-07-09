<?php

namespace App\Http\Controllers;

use App\Models\Haircut;
use Illuminate\Http\Request;

class HaircutController extends Controller
{
    public function create()
    {
        return view('haircuts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'image' => 'required|image|max:4096',
        ]);

        $path = $request->file('image')->store('haircuts', 'public');

        Haircut::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'image_path' => $path,
            'approved' => false,
        ]);

        return redirect()->route('home')->with('status', 'Il tuo taglio è stato inviato! Sarà visibile dopo l\'approvazione del barbiere.');
    }
}