<?php
/**
 * Created by PhpStorm.
 * User: youssef
 * Date: 04/04/2019
 * Time: 23:03
 */

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Exception\EmptyBodyException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Request;

class EmptyBodySubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['handleEmptyBody', EventPriorities::POST_DESERIALIZE]
        ];
    }

    public function handleEmptyBody(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $method = $request->getMethod();
        $route = $request->get('route');

        if (!in_array($method, [Request::METHOD_POST, Request::METHOD_PUT]) || in_array($request->getContentType(), ['html', 'form']) || substr($route, 0, 3) !== 'api'){
            return;
        }

        $data = $event->getRequest()->get('data');

        if (null === $data){
            throw new EmptyBodyException();
        }
    }
}