<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        $contactForm = $this->createForm(\App\Form\ContactFormType::class);

        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'contactForm' => $contactForm->createView(),
        ]);
    }
}
