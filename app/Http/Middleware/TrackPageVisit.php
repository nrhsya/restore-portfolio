<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Project;

class TrackPageVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // to avoid including me visiting the admin page from adding to the page visit count
        // Don't track Filament/admin pages.
        if ($request->is('admin') || $request->is('admin/*')) {
            return $response;
        }

        // Only track successful GET requests.
        if (! $request->isMethod('GET') || ! $response->isSuccessful()) {
            return $response;
        }

        $sessionId = $request->session()->getId();

        $path = $request->path() === '/'
            ? '/'
            : '/' . ltrim($request->path(), '/');

        // Don't record the same page more than once per session.
        $alreadyVisited = PageVisit::query()
            ->where('session_id', $sessionId)
            ->where('path', $path)
            ->exists();

        if ($alreadyVisited) {
            return $response;
        }

        $pageType = $this->getPageType($request);
        $pageId = $this->getPageId($request, $pageType);

        PageVisit::create([
            'session_id' => $sessionId,
            'path' => $path,
            'page_type' => $pageType,
            'page_id' => $pageId,
            'referrer' => $request->headers->get('referer'),
        ]);

        return $response;
    }

    private function getPageType(Request $request): string
    {
        return match ($request->route()?->getName()) {
            'home' => 'home',
            'projects.index' => 'projects',
            'projects.show' => 'project',
            default => 'other',
        };
    }

    private function getPageId(Request $request, string $pageType): ?int
    {
        if ($pageType !== 'project') {
            return null;
        }

        $project = $request->route('project');

        if ($project instanceof Project) {
            return $project->id;
        }

        return null;
    }
}
