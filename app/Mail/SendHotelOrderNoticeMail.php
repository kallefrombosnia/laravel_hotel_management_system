<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendHotelOrderNoticeMail extends Mailable
{
    use Queueable, SerializesModels;

    private $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.reservation_admin')
                        ->with([
                            'arrival_date' => $this->order['arrival_date'],
                            'leave_date' => $this->order['leave_date'],
                            'total_days' => $this->order['total_days'],
                            'total_price' => $this->order['total_price'],
                            'discount' => $this->order['discount'],
                            'room_name' => $this->order['room_name'],
                            'name' => $this->order['customer_name'],
                            'note' => $this->order['note'],
                            'reservation_date' => $this->order['reservation_date']
                        ]);
    }
}
