<?php

namespace App\Http\Controllers;


use App\Http\Requests\Link\LinkCreateRequest;
use App\Services\LinkService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class LinkController extends Controller
{
    /**
     * @var LinkService
     */
    private LinkService $linkService;

    /**
     * @param LinkService $linkService
     */
    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $links = $this->linkService->getAllLinks();

        return view('create_link',['links' => $links]);
    }

    /**
     * @param LinkCreateRequest $request
     * @return RedirectResponse
     */
    public function create(LinkCreateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $link = $request->validated();

        try {
            $this->linkService->createLink($link);

            return redirect()->route('home')->with('message','Link added Successfully');
        }catch (\Exception $exception)
        {
            return redirect()->route('home')->with('error',$exception->getMessage());
        }
    }

    /**
     * @param $token
     * @return Redirector|Application|RedirectResponse
     */
    public function show($token): \Illuminate\Routing\Redirector|Application|RedirectResponse
    {
        $link = $this->linkService->showLink($token);

        return redirect()->to($link);
    }
}
