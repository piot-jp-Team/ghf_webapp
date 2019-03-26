<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertMail extends Mailable
{
    use Queueable, SerializesModels;

    private $sensorName;
    private $sddValue;
    private $limitUpper;
    private $limitUnder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $sensorName,float $sddValue,float $limitUpper,float $limitUnder)
    {
        $this->sensorName = $sensorName;
        $this->sddValue   = $sddValue;
        $this->limitUpper = $limitUpper;
        $this->limitUnder = $limitUnder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('alert@example.com')
        ->subject('アラートメール')
        ->view('emails.alert')
        ->with(['sensorName'=> $this->sensorName,
                'sddValue'  => $this->sddValue,
                'limitUpper'=> $this->limitUpper,
                'limitUnder'=> $this->limitUnder,
               ]);
    }
}
