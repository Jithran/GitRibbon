<?php

namespace Jithran\GitRibbon\Services;

use Illuminate\Support\Facades\Process;

class GitRibbonService
{

    private ?bool $enabled = null;
    //private string $version;
    /**
     * @var \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed|null
     */
    private mixed $app;

    public function __construct($app = null)
    {
        if (!$app) {
            $app = app();   //Fallback when $app is not given
        }
        $this->app = $app;
        //$this->version = $app->version();
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
        $return = '';

        // check if there are uncommitted changes
        $process = Process::run('git status --porcelain');
        if ($process->successful()) {
            if (!empty($process->output())) {

                // get a list of all the files that have been changed
                $files = explode("\n", $process->output());
                $files = array_filter($files);

                $icons = [
                    ' ' => '+',
                    'D' => '&ndash;',
                    'M' => '&Delta;',
                    '?' => '&bull;'
                ];

                // display the files that have been changed in a popover
                $popover = '<div class="popover" style="display: none;position: absolute;top: 0;right: 0;z-index: 1000;width: 300px;padding: 10px;background-color: #fff;border: 1px solid #ccc;border-radius: 5px;box-shadow: 0 0 10px #ccc;">';
                $popover .= '<h4 style="margin: 0 0 10px 0;">Changed Files</h4>';
                $popover .= '<ul style="margin: 0;padding: 0;list-style: none;">';
                foreach ($files as $file) {
                    $status = substr(
                        $file,
                        1,
                        1
                    );
                    $filename = substr($file, 3);

                    if (isset($icons[$status])) {
                        $icon = $icons[$status];
                        $popover .= '<li>'.$icon.'</span>' . $filename . '</li>';
                    } else {
                        $popover .= '<li>' . $filename . '</li>';
                    }
                }
                $popover .= '</ul>';
                $popover .= '</div>';

                // create a ribbon for the right top corner of the page
                $return .= '<div class="changed" style="width: 95px;height: 95px;position: absolute;top: -3px;right: 0;z-index:1000; overflow: hidden;">';
                $return .= '<div class="ribbon" style="font: bold 12px sans-serif;color: #fff;text-align: center;-webkit-transform: rotate(45deg);-moz-transform:rotate(45deg);-ms-transform:rotate(45deg);-o-transform:      rotate(45deg);position: relative;padding: 7px 0;top: 15px;right: 0;width: 120px;background-color: #ea2030; text-shadow: #0a0a0a;">Changed</div>';
                $return .= '</div>';
                $return .= $popover;

                // add event listener to show popover on hover
                $return .= '<script>';
                $return .= 'const changedElement = document.querySelector(".changed");';
                $return .= 'const popoverElement = document.querySelector(".popover");';
                $return .= 'changedElement.addEventListener("mouseover", () => { popoverElement.style.display = "block"; });';
                $return .= 'popoverElement.addEventListener("mouseover", () => { popoverElement.style.display = "block"; });';
                $return .= 'popoverElement.addEventListener("mouseout", () => { popoverElement.style.display = "none"; });';
                $return .= '</script>';
            } else {
                // create a ribbon for the right top corner of the page
                $return = '<div style="width: 95px;height: 95px;overflow: hidden;position: absolute;top: -3px;right: 0;z-index:1000;">';
                $return .= '<div class="ribbon" style="font: bold 12px sans-serif;color: #fff;text-align: center;-webkit-transform: rotate(45deg);-moz-transform:rotate(45deg);-ms-transform:rotate(45deg);-o-transform:      rotate(45deg);position: relative;padding: 7px 0;top: 15px;right: 0;width: 120px;background-color: #0a0; text-shadow: #0a0a0a;">UpToDate</div>';
                $return .= '</div>';
            }
        } else {
            $return = '<div style="width: 95px;height: 95px;overflow: hidden;position: absolute;top: -3px;right: 0;z-index:1000;">';
            $return .= '<div class="ribbon" style="font: bold 12px sans-serif;color: #fff;text-align: center;-webkit-transform: rotate(45deg);-moz-transform:rotate(45deg);-ms-transform:rotate(45deg);-o-transform:      rotate(45deg);position: relative;padding: 7px 0;top: 15px;right: 0;width: 120px;background-color: #ea2030; text-shadow: #0a0a0a;" title="' . $process->errorOutput() . '">Error</div>';
            $return .= '</div>';
        }

        return $return;
    }
}
