<?php

namespace Nanuc\FrontendMail;

use Illuminate\Mail\MailManager;
use Illuminate\Support\ServiceProvider;
use Nanuc\FrontendMail\Http\View\Components\Mail;
use Nanuc\FrontendMail\Transport\FrontendMailTransport;

class FrontendMailServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'frontend-mail');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewComponentsAs('frontend', [
            Mail::class,
        ]);
    }

    public function register()
    {
        $this->app->afterResolving('mail.manager', function (MailManager $mailManager) {
            $frontendTransport = new FrontendMailTransport();
            $mailManager->extend('frontend', fn () => $frontendTransport);
        });
    }
}
