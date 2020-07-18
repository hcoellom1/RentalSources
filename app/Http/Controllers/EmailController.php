<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvoice;

class EmailController extends Controller
{
    public function sendEmail(Request $request){

        $data =[
            'subject' => 'RentalHn',
            'Message' => 'Online a Text'
        ];

    }
}
