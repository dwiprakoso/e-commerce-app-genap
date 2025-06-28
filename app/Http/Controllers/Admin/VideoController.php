<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();
        return view('admin.page.video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.page.video.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:500',
        ], [
            'title.required' => 'Judul video wajib diisi',
            'title.max' => 'Judul video maksimal 255 karakter',
            'url.required' => 'URL video wajib diisi',
            'url.url' => 'URL video harus valid',
            'url.max' => 'URL video maksimal 500 karakter',
        ]);

        // Convert YouTube URL to embed format if needed
        $embedUrl = $this->convertToEmbedUrl($request->url);

        Video::create([
            'title' => $request->title,
            'url' => $embedUrl,
        ]);

        return redirect()->route('admin.video.index')
            ->with('success', 'Video berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.page.video.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:500',
        ], [
            'title.required' => 'Judul video wajib diisi',
            'title.max' => 'Judul video maksimal 255 karakter',
            'url.required' => 'URL video wajib diisi',
            'url.url' => 'URL video harus valid',
            'url.max' => 'URL video maksimal 500 karakter',
        ]);

        $video = Video::findOrFail($id);

        // Convert YouTube URL to embed format if needed
        $embedUrl = $this->convertToEmbedUrl($request->url);

        $video->update([
            'title' => $request->title,
            'url' => $embedUrl,
        ]);

        return redirect()->route('admin.video.index')
            ->with('success', 'Video berhasil diupdate!');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.video.index')
            ->with('success', 'Video berhasil dihapus!');
    }

    /**
     * Convert YouTube URL to embed format
     */
    private function convertToEmbedUrl($url)
    {
        // If already embed URL, return as is
        if (strpos($url, 'embed') !== false) {
            return $url;
        }

        // Convert YouTube watch URL to embed URL
        if (strpos($url, 'youtube.com/watch') !== false) {
            $videoId = '';
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            if (isset($params['v'])) {
                $videoId = $params['v'];
            }
            return 'https://www.youtube.com/embed/' . $videoId;
        }

        // Convert YouTube short URL to embed URL
        if (strpos($url, 'youtu.be') !== false) {
            $videoId = basename(parse_url($url, PHP_URL_PATH));
            return 'https://www.youtube.com/embed/' . $videoId;
        }

        // Return original URL if not YouTube
        return $url;
    }
}
