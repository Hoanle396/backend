<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    private $data;
    public $subject;
    public $view;
    public function __construct($data, $subject, $view)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hoanlaydiema@gmail.com', 'ĐỒ ÁN')->subject($this->subject)->view($this->view)->with($this->data);
    }
}
