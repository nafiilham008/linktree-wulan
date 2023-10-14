<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\Storage;

class LinkController extends Controller
{
    /**
     * Store a newly created link in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:60',
            'url' => 'required|url|max:255',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $folderName = 'link-image';

        if (!Storage::disk('public')->exists($folderName)) {
            Storage::disk('public')->makeDirectory($folderName);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store($folderName, 'public');
        }

        Link::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Show the form for editing the specified link.
     *
     * @param Link $link
     * @return void
     */
    public function edit(Link $link)
    {
        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified link in storage.
     *
     * @param Request $request
     * @param Link $link
     * @return void
     */
    public function update(Request $request, Link $link)
    {
        $request->validate([
            'title' => 'required|max:60',
            'url' => 'required|url|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data = [
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $folderName = 'link-image';

            if (!Storage::disk('public')->exists($folderName)) {
                Storage::disk('public')->makeDirectory($folderName);
            }

            // Delete the old image
            if ($link->image) {
                Storage::disk('public')->delete($link->image);
            }

            // Save new image
            $imagePath = $request->file('image')->store($folderName, 'public');

            // Add image path to data
            $data['image'] = $imagePath;
        }

        $link->update($data);

        return redirect()->route('dashboard');
    }



    /**
     * Undocumented function
     *
     * @param Link $link
     * @return void
     */
    public function destroy(Link $link)
    {
        // If there's an associated image, delete it
        if ($link->image) {
            $imagePath = public_path('storage/' . $link->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the Link record from the database
        $link->delete();

        return redirect()->route('dashboard');
    }
}
