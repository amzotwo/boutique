<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;


class Mail
{
    private $api_key = '9993cd0eeb090f9ff60cee261c260be7';
    private $api_key_secret = '522962c393eef10fd9f5a85950cd49eb';

    public function send($to_email,$to_name,$subject,$content){

        $mj = new Client($this->api_key,$this->api_key_secret,true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "sonedafrique@gmail.com  ",
                        'Name' => "Darou Salam Tech"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 3933878,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content'=> $content,
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && dd($response->getData());
}

    public function sendMail($to_email,$to_name,$subject,$content){
   //     require 'vendor/autoload.php';
        $mj = new Client(getenv($this->api_key), getenv($this->api_key_secret),true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "sonedafrique@gmail.com",
                        'Name' => "Darou Salam Tech"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 3933878,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => json_decode('{
    "content": ""
  }', true)
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
    }

}
?>