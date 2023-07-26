<?php

namespace Jithran\GitRibbon;

class RibbonData
{
    protected string $label;
    protected string $name;
    protected string $bgColor;
    protected ?string $tooltipInfo = null;

    public function __construct(?string $name = null, ?string $label = null, ?string $bgColor = null, ?string $tooltipInfo = null)
    {
        $this->name = $name ?? '';
        $this->label = $label ?? '';
        $this->bgColor = $bgColor ?? '';
        $this->tooltipInfo = $tooltipInfo;
    }

    public function render(): string
    {
        return view('git-ribbon::ribbon')->with('ribbon', $this)->render();
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return \Jithran\GitRibbon\RibbonData
     */
    public function setLabel(string $label): RibbonData
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getBgColor(): string
    {
        return $this->bgColor;
    }

    /**
     * @param string $bgColor
     * @return \Jithran\GitRibbon\RibbonData
     */
    public function setBgColor(string $bgColor): RibbonData
    {
        $this->bgColor = $bgColor;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTooltipInfo(): ?string
    {
        return $this->tooltipInfo;
    }


    /**
     * @param string $tooltipInfo
     * @return RibbonData
     */
    public function setTooltipInfo(string $tooltipInfo): RibbonData
    {
        $this->tooltipInfo = $tooltipInfo;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return RibbonData
     */
    public function setName(string $name): RibbonData
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set preset for ribbon data from a config file
     * @param string $preset
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setPreset(string $preset): RibbonData
    {
        if(!isset(config('git-ribbon.presets.' . $preset)['label'])) {
            throw new \InvalidArgumentException('Preset ' . $preset . ' not found');
        }

        $this->setName($preset);
        $this->setLabel(config('git-ribbon.presets.' . $preset . '.label'));
        $this->setBgColor(config('git-ribbon.presets.' . $preset . '.bgColor'));
        return $this;
    }
}