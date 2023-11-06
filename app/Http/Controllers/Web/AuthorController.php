<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $author): View
    {
        return view('authors.index');
    }
}
