<?php

namespace App\Mail;

use App\Models\Thing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use phpDocumentor\Reflection\Types\Object_;

class GetThingsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $thing;

    public function __construct(Thing $thing)
    {
        $this->thing = $thing;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Уведомление о назначении')
            ->from('shalkir934@gmail.com', 'Kirill')
            ->view('mail.getThings');
    }
}
