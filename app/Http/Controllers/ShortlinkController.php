<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;

class ShortlinkController extends Controller
{
    public function redirect($alias)
    {
        $shortlink = ShortLink::where('alias', $alias)->first();

        if (! $shortlink) {
            abort(404, 'Link tidak ditemukan');
        }

        // Optional: simpan jumlah klik
        $shortlink->increment('clicks');

        return redirect()->away($shortlink->original_url);
    }
}
