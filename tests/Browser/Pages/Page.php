<?php

namespace Tests\Browser\Pages;

trait Page
{
    /**
     * Get the global element shortcuts for the site.
     *
     * @return array<string, string>
     */
    public static function siteElements(): array
    {
        return [
            '@novo' => '#novo',
        ];
    }
}
