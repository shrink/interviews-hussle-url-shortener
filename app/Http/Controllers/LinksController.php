<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Links\Link;
use App\Links\Manager;
use App\Http\Requests\CreateLinkRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LinksController extends Controller
{
    /**
     * Constructs a new link controller.
     *
     * @param \App\Links\Manager $links
     */
    public function __construct(Manager $links)
    {
        $this->links = $links;
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

        return redirect()->route('links.meta', $link);
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
            'link' => $link,
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
