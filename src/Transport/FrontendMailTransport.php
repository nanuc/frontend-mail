<?php
namespace Nanuc\FrontendMail\Transport;

use Illuminate\Mail\Transport\Transport;
use Nanuc\FrontendMail\FrontendMail;
use Swift_Mime_SimpleMessage;

class FrontendMailTransport extends Transport
{
    /**
     * {@inheritdoc}
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        $mails = cache()->get($this->getCacheKey($message)) ?? [];
        $mails[] = [
            'from' => $this->formatArray($message->getFrom()),
            'to' => $this->formatArray($message->getTo()),
            'subject' => $message->getSubject(),
            'body' => $message->getBody(),
        ];
        cache()->put($this->getCacheKey($message), $mails);

        $this->sendPerformed($message);
    }

    private function formatArray($array)
    {
        return collect($array)->map(fn($name, $email) => compact('name', 'email'))->values()->toArray();
    }

    private function getCacheKey($message)
    {
        $key = $message->getHeaders()->get('Frontend-Mail-Id')?->getValue() ?? session()->get('frontend-mail-id');
        return 'frontend-mail-' . $key;
    }
}