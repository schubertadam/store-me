<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Auth extends Component
{
    public string $title = "";

    public function __construct(string $title = "")
    {
        if (!empty($title)) {
            $this->title = $title . " | ";
        }

        $this->title .= config('app.name');
    }

    public function render()
    {
        return view('components.layouts.auth');
    }
}
