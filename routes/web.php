<?php

use App\Http\Controllers\TrackController;
use App\Http\Controllers\Webhooks\SoundcloudTrackWebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TrackController::class, 'index'])->name('tracks.index');

Route::post('/webhooks/soundcloud-track', [SoundcloudTrackWebhookController::class, 'store'])
    ->name('webhooks.soundcloud-track');
