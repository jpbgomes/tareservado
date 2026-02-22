<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public $favicon;
    public $title;
    public $description;
    public $keywords;
    public $banner;

    /**
     * Create a new component instance.
     */
    public function __construct($favicon = null, $title = null, $description = null, $keywords = null, $banner = null)
    {
        $this->favicon = $favicon;
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->banner = $banner;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.layouts.app');
    }
}
