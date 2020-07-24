<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Crypt;

use App\CustomClasses\ClientRequest;

class MessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Store request information
     */
    public $request;

    /**
     * Store machines required in request
     */
    public $machines;

    
    /**
     * Property for request id
     */
    public $requestId;

    /**
     * Values
     *  IQ = Inquiry, send mail to rental
     *  OM = Owner machine, send mail for every owner of machines in request detail
     *  RQ = Requester, send mail to requester
     */
    private $destinatary;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    //public function __construct(ClientRequest $request, Collection $destinatary)
    public function __construct($request, $machines, $destinatary, $requestId)
    {
       $this->request = $request;
       $this->machines = $machines;
       $this->destinatary = $destinatary;
       $this->requestId = $requestId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->destinatary == 'RQ')
            return $this->subject('Nueva Solicitud de Renta')->view('emails.message-received');

        if ($this->destinatary == 'IQ'){            
            return $this->subject('Nueva Solicitud de Renta')->view('emails.message-received-inquiry');
        }
            
        if ($this->destinatary == 'OM')
            return $this->subject('Rental - Nueva petición de maquinaria')->view('emails.message-received-omachine');
    }
    
}
