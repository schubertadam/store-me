<?php

namespace App\View\Components\Layouts;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Admin extends Component
{
    public string $title = "";

    public function __construct(string $title = "")
    {
        if (!empty($title)) {
            $this->title = $title . " | ";
        }

        $this->title .= config('app.name');
    }

    public function render(): View
    {
        return view('components.layouts.admin');
    }
}
