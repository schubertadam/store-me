<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

abstract class AbstractBaseLayout extends Component
{
    public string $title;

    public function __construct(string $title)
    {
        if (!empty($title)) {
            $this->title = $title . " | ";
        }

        $this->title .= config('app.name');
    }

    abstract public function render();
}
