@php
use \Jithran\GitRibbon\Services\GitService;
$git = new GitService();
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="git-ribbon-popover-trigger" style="width: 95px;height: 95px;overflow: hidden;position: absolute;top: -3px;right: 0;z-index:1000;">
    <div class="ribbon" style="font: bold 12px sans-serif;color: #fff;text-align: center;-webkit-transform: rotate(45deg);-moz-transform:rotate(45deg);-ms-transform:rotate(45deg);-o-transform:      rotate(45deg);position: relative;padding: 7px 0;top: 15px;right: 0;width: 120px;background-color: {{$ribbon->getBgColor()}}; text-shadow: #0a0a0a;">
        {{$ribbon->getLabel()}}
    </div>
</div>

<div class="git-ribbon-popover">
    <div class="grp-container">
        <div class="grp-container-info">
            <div class="grp-title">Project information</div>
            <div class="grp-table">
                <div class="grp-row">
                    <div class="grp-cell grp-label">Git Branch:</div>
                    <div class="grp-cell grp-value">{{$git->getBranchName()}}</div>
                </div>
                <div class="grp-row">
                    <div class="grp-cell grp-label">Git Version:</div>
                    <div class="grp-cell grp-value">{{$git->getGitVersion()}}</div>
                </div>
                <div class="grp-row">
                    <div class="grp-cell grp-label">Laravel Version:</div>
                    <div class="grp-cell grp-value">{{app()->version()}}</div>
                </div>
                <div class="grp-row">
                    <div class="grp-cell grp-label">PHP Version:</div>
                    <div class="grp-cell grp-value">{{phpversion()}}</div>
                </div>
            </div>
        </div>
        @if($ribbon->getTooltipInfo())
        <div class="grp-container-content">
            {!! $ribbon->getTooltipInfo() !!}
        </div>
        @endif
    </div>
</div>

<script>
    const changedElement = document.querySelector(".git-ribbon-popover-trigger");
    const popoverElement = document.querySelector(".git-ribbon-popover");
    changedElement.addEventListener("mouseover", () => {
        popoverElement.style.display = "block";
    });
    popoverElement.addEventListener("mouseover", () => {
        popoverElement.style.display = "block";
    });
    popoverElement.addEventListener("mouseout", () => {
        popoverElement.style.display = "none";
    });
</script>

<style>
    .git-ribbon-popover {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        display: none;
        position: absolute;
        top: 0;
        right: 0;
        z-index: 1000;
        width: auto;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-bottom-left-radius: 2px;
        box-shadow: 0 0 2px #ccc;
    }

    .grp-title {
        font-size: 1.3em;
        margin-bottom: 5px;
        text-decoration: underline;
    }


    .grp-container {
        display: flex;
    }

    .grp-container-info {
        flex-grow: 1;

    }

    .grp-container-content {
        flex-grow: 1;
        min-width: 100px;
        max-width: 60%;
        margin-left: 10px;
        padding-left: 10px;
        border-left: 1px solid #ccc;
    }

    .grp-table {
        display: flex;
        flex-direction: column;
    }

    .grp-row {
        display: flex;
        flex-direction: row;
    }

    .grp-cell {
    }

    .grp-label {
        font-weight: bold;
        width: auto;
        padding-right: 5px;
    }

    .grp-value {
        flex: 1;
    }

    .grp-dirname {
        color: gray;
    }
</style>