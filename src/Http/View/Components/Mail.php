<?php

namespace Nanuc\FrontendMail\Http\View\Components;

use Illuminate\View\Component;

class Mail extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        session()->put('frontend-mail-id', \Illuminate\Support\Str::random());
        return view('frontend-mail::components.frontend-mail');
    }
}
