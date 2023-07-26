<?php

namespace Jithran\GitRibbon\Services;

use Jithran\GitRibbon\RibbonData;

class GitRibbonService
{

    private ?bool $enabled = null;
    //private string $version;
    /**
     * @var \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed|null
     */
    private mixed $app;
    /**
     * @var \Jithran\GitRibbon\Services\GitService
     */
    private GitService $gitService;

    public function __construct($app = null)
    {
        if (!$app) {
            $app = app();   //Fallback when $app is not given
        }
        $this->app = $app;
        //$this->version = $app->version();
        $this->gitService = new GitService();
    }

    public function isEnabled(): bool
    {
        if ($this->enabled === null) {
            $config = $this->app['config'];
            $configEnabled = value(config('git-ribbon.enabled'));

            if ($configEnabled === null) {
                $configEnabled = $config->get('app.debug');
            }

            $this->enabled = $configEnabled && in_array($this->app->environment(), config('git-ribbon.environment'));
        }
        return $this->enabled;
    }

    /**
     * Get the git ribbon.
     * @return string
     */
    public function renderRibbon(): string
    {
        $ribbon = new RibbonData();

        // check if there are uncommitted changes
        $process = $this->gitService->getStatus();
        if ($process->successful()) {
            if (!empty($process->output())) {

                $files = $this->gitService->getChangedFiles();

                // display the files that have been changed in a popover
                $popover = '<h2 class="grp-title">Changed Files</h2>';
                $popover .= '<ul style="margin: 0;padding: 0;list-style: none;">';
                foreach ($files as $file) {
                    $popover .= '<li>';
                    $popover .= '<span class="fa fa-' . $file['status'] . '" aria-hidden="true"></span> ';
                    $popover .= $file['file'];
                    $popover .= '</li>';
                }
                $popover .= '</ul>';

                $ribbon->setPreset('changed');
                $ribbon->setTooltipInfo($popover);
            } else {
                $ribbon->setPreset('no-changes');
            }
        } else {
            $ribbon->setPreset('error');
            $ribbon->setTooltipInfo($process->errorOutput());
        }
        return $ribbon->render();
    }
}
