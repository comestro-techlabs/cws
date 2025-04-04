<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


class ProductRedeem extends Mailable
{
    use Queueable, SerializesModels;

    public $shippingDetails;
    public $productDetail;
    public function __construct($shippingData,$productData)
    {
        $this->shippingDetails = $shippingData;
        $this->productDetail = $productData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Redeemed Succesfully',
            from: new Address(config('mail.from.address'), 'Learn Syntax'),
            replyTo: [new Address($this->shippingDetails->email ,  $this->shippingDetails->first_name)],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.product_redeemed',
            with: ['user' => $this->shippingDetails->first_name,'productDetail'=>$this->productDetail]

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
