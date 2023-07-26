<?php

namespace Jithran\GitRibbon\Services;

use Illuminate\Contracts\Process\ProcessResult;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Process;

class GitService {
    public function getBranchName(): ?string
    {
        $branchName = $this->_getCommandResult('rev-parse --abbrev-ref HEAD');

        if ($branchName === '') {
            return null;
        }

        $this->_cleanupOutput($branchName);

        return $branchName;
    }

    public function getGitVersion(): string
    {
        $version = $this->_getCommandResult('--version');

        preg_match('/\d+\.\d+\.\d+/', $version, $matches);
        if(count($matches) > 0) {
            return $matches[0];
        }

        return 'unknown';
    }

    public function getStatus(): ProcessResult
    {
        // with named arguments
        return $this->_getCommandResult(command: 'status --porcelain', returnObject: true);
    }

    public function getChangedFiles(): Collection
    {
        $files = $this->_getCommandResult('status --porcelain');
        $files = rtrim($files, "\n");

        $files = explode("\n", $files);

        $output = [];
        foreach($files as $file) {

            $output[] = [
                'status' => $this->_processFileStatus($file),
                'file' => substr($file, 3)
            ];
        }

        return collect($output)->sortBy(function($item) {
            return match ($item['status']) {
                'plus' => 1,
                'pencil' => 2,
                'trash' => 3,
                'question' => 4,
                'ellipsis-h' => 5,
                'exclamation-triangle' => 6,
                'redo' => 7,
                'copy' => 8,
                default => 9,
            };
        });
    }

    private function _getCommandResult($command, $returnObject = false): ProcessResult|string
    {
        // if the command does not start with 'git ', add it
        if (!str_starts_with($command, 'git ')) {
            $command = 'git '. $command;
        }

        // prepend the base path
        $command = 'cd ' . base_path() . ' && ' . $command;

        $process = Process::run($command);

        if($returnObject) {
            return $process;
        }

        if ($process->successful()) {
            return $process->output();
        }

        return '';
    }

    private function _cleanupOutput(&$str): void
    {
        // remove line breaks
        $str = str_replace(["\r", "\n"], '', $str);
    }

    private function _processFileStatus(string $file): string
    {
        $statusIndexTree = substr($file, 0, 1);
        $statusWorkingTree = substr($file, 1, 1);

        return match ($statusWorkingTree) {
            'A' => "plus",
            'D' => "trash",
            'M' => "pencil",
            '?' => "ellipsis-h",
            '!' => "exclamation-triangle",
            'R' => "redo",
            'C' => "copy",
            ' ' =>
                match ($statusIndexTree) {
                    'A' => "plus",
                    'D' => "trash",
                    'M' => "pencil",
                    'R' => "redo",
                    'C' => "copy",
                    default => "question",
                },
            default => 'question',
        };

    }
}