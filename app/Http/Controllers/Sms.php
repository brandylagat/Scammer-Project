<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;


class Sms extends Controller
{
    public  function test()
    {
        // 
    }

    public function receiveCall()
    {
         header('content-type: multipart/form-data');
        $apiKey = 'b9025a120fb1ed98cf8fe83545762d5f4fe01f5796cd651a66f745a3cde66626';
        $username = 'sandbox';

        // Initialize the SDK
        $AT = new AfricasTalking($username, $apiKey);

        // Get the SMS service
        $sms = $AT->sms();

        // Set the numbers you want to send to in international format
        $recipients = "+254712449446";

        // Set your message
        // $message = "This number has been reported as a scammer";

        // Set your shortCode or senderId
        $from = "+254790336619";

        try {
        // Thats it, hit send and we'll take care of the rest
        $result = $sms->send([
            'to' => $recipients,
            // 'message' => $message,
            'from' => $from
        ]);

        } 
        catch (Exception $e) {
          echo "Error: ".$e->getMessage();
        }
    }

    public function handleCall()
    {
        $sessionId = $_POST['sessionId'];

        $isActive = $_POST['isActive'];

//        echo "mambo";

        if($isActive == 1)
        {
            $callerNumber = $_POST['callerNumber'];

            $text = "This number has been reported as a scammer";

            $response  = '<?xml version="1.0" encoding="UTF-8"?>';
            $response .= '<Response>';
            $response .= '<Say>'.$text.'</Say>';
            $response .= '</Response>';

            // Print the response onto the page so that our gateway can read it
            header('Content-type: text/plain');
            echo $response;

        }
        else
        {
            $duration     = $_POST['durationInSeconds'];
            $currencyCode = $_POST['currencyCode'];
            $amount       = $_POST['amount'];

        }


//        echo "sasa";
    }
}
