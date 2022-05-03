<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface{
        public static function getSubscriberEvents(){
            return[
                BeforeEntityPersistEvent::class =>
            ]
        }
}
?>