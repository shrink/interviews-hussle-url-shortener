<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Links\Link;
use App\Links\Manager;
use App\Links\Statistics;
use App\Http\Requests\CreateLinkRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LinksController extends Controller
{
    /**
     * Link manager.
     *
     * @var \App\Links\Manager
     */
    protected $links;

    /**
     * Statistics provider.
     *
     * @var \App\Links\Statistics
     */
    protected $statistics;

    /**
     * Constructs a new link controller.
     *
     * @param \App\Links\Manager $links
     */
    public function __construct(Manager $links, Statistics $statistics)
    {
        $this->links = $links;
        $this->statistics = $statistics;
    }

    /**
     * Render the index with statistics.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('links.index', [
            'statistics' => $this->statistics->all(),
        ]);
    }

    /**
     * Creates a new Link.
     *
     * @param \App\Http\Requests\CreateLinkRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreateLinkRequest $request): RedirectResponse
    {
        $link = $this->links->create($request->input('location'));

        return redirect()->route('links.meta', $link->key);
    }

    /**
     * Displays a view containing the meta for a link.
     *
     * @param string $key
     *
     * @return Illuminate\View\View
     */
    public function meta(string $key): View
    {
        $link = $this->links->find($key);

        abort_unless($link, 404);

        return view('links.meta', [
            'url' => route('links.redirect', ['key' => $link->key]),
            'statistics' => $this->statistics->for($link),
        ]);
    }

    /**
     * Redirects to the short URLs location.
     *
     * @param string $key
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect(Request $request, string $key): RedirectResponse
    {
        $link = $this->links->visit($key, $request->ip());

        abort_unless($link, 404);

        return redirect()->away($link->location, 302);
    }
}
