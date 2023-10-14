<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Click;
use Illuminate\Support\Facades\Session;

class ClickController extends Controller
{
    /**
     * Store when a user clicks a link.
     *
     * @param string $link
     * @param string $title
     * @return redirect
     */
    public function store(Request $request, string $link, string $title)
    {
        // Find the link based on the provided link ID and title
        $link = Link::where('id', $link)
            ->where('title', $title)
            ->firstOrFail();

        // Define the session key specific to this link
        $sessionKey = "link_clicked_{$link->id}";

        if (!Session::has($sessionKey)) {
            // If this link ID is not in the session, store it with an expiry of 24 hours (1440 minutes)
            Session::put($sessionKey, true, 1440);

            // Find or create the click entry for this link and increment the attempts
            $click = Click::firstOrNew(['link_id' => $link->id]);
            if (!$click->exists) {
                $click->attempts = 0;
                $click->save();
            }
            $click->increment('attempts');
        }

        // Return the actual link URL
        return response()->json(['url' => $link->url]);
    }
}
