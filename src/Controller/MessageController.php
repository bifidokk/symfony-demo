<?php

namespace App\Controller;

use App\Message\SmsNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/message')]
class MessageController extends AbstractController
{
    public function __construct(private MessageBusInterface $bus)
    {
    }

    #[Route('')]
    public function index(): Response
    {
        $this->bus->dispatch(new SmsNotification('Look! I created a message!'));

        return $this->render('default/homepage.html.twig');
    }
}