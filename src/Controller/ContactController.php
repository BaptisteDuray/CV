<?php

// src/Controller/ContactController.php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $contact = new Contact();
        $contactForm = $this->createForm(ContactFormType::class, $contact);

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $attachmentFile = $contactForm->get('attachment')->getData();
            if ($attachmentFile) {
                $originalFilename = pathinfo($attachmentFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$attachmentFile->guessExtension();

                try {
                    $attachmentFile->move(
                        $this->getParameter('attachments_directory'),
                        $newFilename
                    );
                    $contact->setAttachment($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'There was an error uploading your file.');
                }
            }

            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash('success', 'Your message has been sent, I will answer you soon.');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'contactForm' => $contactForm->createView(),
        ]);
    }
}
