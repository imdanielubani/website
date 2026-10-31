<?php

namespace App\Http\Controllers;

use App\Content\NewsRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class NewsController extends Controller
{
    private const PER_PAGE = 9;

    public function __construct(private readonly NewsRepository $news) {}

    public function index(): View
    {
        $articles = $this->news->published();

        return view('pages.news.index', [
            'featured' => $articles->first(),
            'articles' => $this->paginate($articles->slice(1)->values()),
            'categories' => $this->news->categories(),
            'activeCategory' => null,
        ]);
    }

    public function category(string $category): View
    {
        $categories = $this->news->categories();

        abort_unless($categories->has($category), 404);

        return view('pages.news.index', [
            'featured' => null,
            'articles' => $this->paginate($this->news->inCategory($category)),
            'categories' => $categories,
            'activeCategory' => $category,
        ]);
    }

    public function show(string $slug): View
    {
        $article = $this->news->find($slug);

        abort_if($article === null, 404);

        return view('pages.news.show', [
            'article' => $article,
            'related' => $this->news->related($article),
        ]);
    }

    private function paginate(Collection $items): LengthAwarePaginator
    {
        $page = LengthAwarePaginator::resolveCurrentPage();

        return new LengthAwarePaginator(
            $items->forPage($page, self::PER_PAGE)->values(),
            $items->count(),
            self::PER_PAGE,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()],
        );
    }
}
