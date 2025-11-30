<?php

namespace App\View\Composers;

use App\Models\SiteSettings;
use Illuminate\View\View;

class SiteSettingsComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('globalSiteSettings', SiteSettings::first());
    }
}
