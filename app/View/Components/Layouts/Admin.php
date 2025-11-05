<?php

namespace App\View\Components\Layouts;

use Illuminate\Contracts\View\View;

class Admin extends AbstractBaseLayout
{
    public function __construct(string $title = '')
    {
        parent::__construct($title);
    }

    public function render(): View
    {
        return view('components.layouts.admin');
    }
}
