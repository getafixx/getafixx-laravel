<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Receives one row per track from the "New Track I Like" Zapier automation
 * (the same Zap that posts the track to Instagram) via a Webhooks by Zapier
 * "POST" action, and stores it so it shows up on the getafixx.com tracklist.
 */
class SoundcloudTrackWebhookController extends Controller
{
    public function store(Request $request)
    {
        // A shared secret keeps this endpoint from being spammed by anyone
        // who finds the URL. Set WEBHOOK_SECRET in .env and configure the
        // same value as a header in the Zapier webhook action.
        if ($request->header('X-Webhook-Secret') !== config('services.soundcloud_webhook.secret')) {
            abort(Response::HTTP_UNAUTHORIZED, 'Invalid webhook secret.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'artwork_url' => ['required', 'url', 'max:2048'],
            'track_url' => ['required', 'url', 'max:2048'],
            'posted_at' => ['nullable', 'date'],
        ]);

        $track = Track::create([
            ...$validated,
            'posted_at' => $validated['posted_at'] ?? now(),
        ]);

        return response()->json(['id' => $track->id], Response::HTTP_CREATED);
    }
}
