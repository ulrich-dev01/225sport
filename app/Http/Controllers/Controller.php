<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function categories()
    {
        $categories = category::all();
        return view('base', compact('categories'));
    }
}