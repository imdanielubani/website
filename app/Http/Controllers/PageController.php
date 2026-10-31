<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about');
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function trading(): View
    {
        return view('pages.trading');
    }

    public function processing(): View
    {
        return view('pages.processing');
    }

    public function infrastructure(): View
    {
        return view('pages.infrastructure');
    }

    public function hse(): View
    {
        return view('pages.hse');
    }

    public function sustainability(): View
    {
        return view('pages.sustainability');
    }

    public function careers(): View
    {
        return view('pages.careers');
    }

    public function privacy(): View
    {
        return view('pages.legal.privacy');
    }

    public function cookies(): View
    {
        return view('pages.legal.cookies');
    }

    public function terms(): View
    {
        return view('pages.legal.terms');
    }
}
