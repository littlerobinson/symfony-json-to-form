<?php

namespace App\Dto;

/**
 * Class SiteConfigCustomizationDto
 * this object represent the json field "custom" from SiteConfig entity
 * @package App\Dto\Paylogic
 *
 * exemple :
 * {
    "primary": "#319794",
    "fontTitle": "roboto",
    "fontBody": "montserrat",
    "navBackground": "#202020",
    "navColor": "#7e7e7e",
    "navIcon": "#7e7e7e",
    "btnResaleBackground": "#b46816",
    "btnRound": "0em",
    "footerBackground": "#262627",
    "footerColor": "#798185"
    }
 */
final class SiteConfigCustomizationDto
{
    /**
     * @var string
     */
    public $primary;

    /**
     * @var string
     */
    public $fontTitle;

    /**
     * @var string
     */
    public $fontBody;

    /**
     * @var string
     */
    public $navBackground;

    /**
     * @var string
     */
    public $navColor;

    /**
     * @var string
     */
    public $navIcon;

    /**
     * @var string
     */
    public $btnResaleBackground;

    /**
     * @var string
     */
    public $btnRound;

    /**
     * @var string
     */
    public $footerBackground;

    /**
     * @var string
     */
    public $footerColor;
}