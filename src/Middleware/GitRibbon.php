<?php

namespace Jithran\GitRibbon\Middleware;

use Illuminate\Http\Response;
use Jithran\GitRibbon\Services\GitRibbonService;

class GitRibbon
{
    /**
     * @var \Jithran\GitRibbon\Services\GitRibbonService
     */
    private GitRibbonService $gitRibbonService;

    public function __construct(GitRibbonService $gitRibbonService)
    {
        $this->gitRibbonService = $gitRibbonService;
    }

    public function handle($request, \Closure $next)
    {
        if ($this->gitRibbonService->isEnabled() === false) {
            return $next($request);
        }

        $ribbonHtml = $this->gitRibbonService->renderRibbon();

        $response = $next($request);

        if ($response instanceof Response) {
            $content = $response->getContent();
            $content = str_replace('</body>', $ribbonHtml . '</body>', $content);
            $response->setContent($content);
        }

        return $response;
    }
}