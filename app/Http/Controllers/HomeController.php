<?php

namespace App\Http\Controllers;

use App\Content\NewsRepository;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(NewsRepository $news): View
    {
        return view('pages.home', [
            'latest' => $news->published()->take(3),
        ]);
    }
}
