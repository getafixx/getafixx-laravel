<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>getafixx — tracklist</title>
<meta name="description" content="Mixes and tracks worth a rewind, straight from SoundCloud.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root {
    /*
     * Swap these for the real getafixx.com brand hex values whenever
     * you have them handy — everything else references these tokens.
     */
    --ink: #12141c;
    --ink-raised: #1a1d29;
    --paper: #eef0f4;
    --paper-dim: #8a93a6;
    --amber: #e8a33d;
    --rust: #c8553d;
    --hairline: #2a2e3d;
  }

  * { box-sizing: border-box; }

  html { -webkit-font-smoothing: antialiased; }

  body {
    margin: 0;
    background: var(--ink);
    color: var(--paper);
    font-family: 'Space Grotesk', sans-serif;
    line-height: 1.5;
  }

  a { color: inherit; }

  .wrap {
    max-width: 720px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .hero {
    padding: 96px 0 56px;
    text-align: center;
  }

  .mark {
    display: inline-block;
    font-size: clamp(48px, 12vw, 96px);
    font-weight: 700;
    letter-spacing: -0.02em;
    line-height: 1;
    margin: 0;
    cursor: default;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .mark:hover { transform: rotate(-2deg); }

  .tagline {
    margin: 18px auto 0;
    max-width: 34ch;
    color: var(--paper-dim);
    font-size: 17px;
  }

  .profiles {
    margin-top: 32px;
    display: flex;
    justify-content: center;
    gap: 28px;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 13px;
  }

  .profiles a {
    text-decoration: none;
    color: var(--amber);
    border-bottom: 1px solid transparent;
    padding-bottom: 2px;
    transition: border-color 0.2s ease;
  }

  .profiles a:hover,
  .profiles a:focus-visible {
    border-color: var(--amber);
  }

  .tracklist-heading {
    padding-top: 40px;
    border-top: 1px solid var(--hairline);
    font-size: 15px;
    color: var(--paper-dim);
    margin-bottom: 4px;
  }

  ol.tracklist {
    list-style: none;
    margin: 0 0 80px;
    padding: 0;
  }

  .track {
    display: grid;
    grid-template-columns: 34px 52px 1fr;
    gap: 16px;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px solid var(--hairline);
  }

  .track a.row-link {
    display: contents;
    text-decoration: none;
  }

  .track-num {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 13px;
    color: var(--paper-dim);
  }

  .track-art {
    width: 52px;
    height: 52px;
    object-fit: cover;
    background: var(--ink-raised);
    flex-shrink: 0;
  }

  .track-info { min-width: 0; }

  .track-title {
    font-size: 16px;
    font-weight: 500;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .track-date {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 12px;
    color: var(--paper-dim);
    margin-top: 3px;
  }

  .track:hover .track-title,
  .track:focus-within .track-title {
    color: var(--rust);
  }

  .track a.row-link:focus-visible {
    outline: 2px solid var(--amber);
    outline-offset: 4px;
  }

  .empty-state {
    padding: 40px 0;
    color: var(--paper-dim);
    font-family: 'IBM Plex Mono', monospace;
    font-size: 14px;
  }

  footer {
    padding: 32px 0 56px;
    text-align: center;
    color: var(--paper-dim);
    font-family: 'IBM Plex Mono', monospace;
    font-size: 12px;
  }

  @media (prefers-reduced-motion: reduce) {
    .mark { transition: none; }
  }
</style>
</head>
<body>

  <div class="wrap">
    <div class="hero">
      <h1 class="mark">getafixx</h1>
      <p class="tagline">Selects and mixes worth a rewind, posted here as they land on Instagram.</p>
      <div class="profiles">
        <a href="https://instagram.com/getafixx" target="_blank" rel="noopener">Instagram</a>
        <a href="https://soundcloud.com/getafixx" target="_blank" rel="noopener">SoundCloud</a>
      </div>
    </div>

    <h2 class="tracklist-heading">Latest tracks</h2>

    @if ($tracks->isEmpty())
      <p class="empty-state">Nothing posted yet — check back soon.</p>
    @else
      <ol class="tracklist">
        @foreach ($tracks as $track)
          <li class="track">
            <a class="row-link" href="{{ $track->track_url }}" target="_blank" rel="noopener">
              <span class="track-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
              <img class="track-art" src="{{ $track->artwork_url }}" alt="" loading="lazy">
              <span class="track-info">
                <span class="track-title">{{ $track->title }}</span>
                <span class="track-date">{{ optional($track->posted_at)->format('M j, Y') }}</span>
              </span>
            </a>
          </li>
        @endforeach
      </ol>
    @endif

    <footer>getafixx &middot; updated automatically from SoundCloud</footer>
  </div>

</body>
</html>
