<?php

namespace App\View\Components\Layouts;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Guest extends AbstractBaseLayout
{
    public function __construct(string $title = '')
    {
        parent::__construct($title);
    }

    public function render(): View
    {
        return view('components.layouts.guest');
    }
}
