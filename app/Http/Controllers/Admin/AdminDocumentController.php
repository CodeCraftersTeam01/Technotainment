<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminDocumentController extends Controller
{
    /**
     * Serve a private file from the local storage.
     *
     * @param string $path
     * @return StreamedResponse
     */
    public function serve(string $path)
    {
        // Only authenticated admins should be able to access this
        // The middleware 'auth' is already applied in routes/web.php

        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return Storage::disk('local')->response($path);
    }
}
