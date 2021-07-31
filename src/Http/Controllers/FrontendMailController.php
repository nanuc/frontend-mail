<?php

namespace Nanuc\FrontendMail\Http\Controllers;

use Illuminate\Routing\Controller;

class FrontendMailController extends Controller
{
    public function __invoke($id)
    {
        return cache()->pull('frontend-mail-' . $id) ?? [];
    }
}
