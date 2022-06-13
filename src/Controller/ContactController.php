<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\contact;

class ContactController extends AbstractController
{
 /**
  * @Route("/contact", name="contact")
  */
  
    


  function createcontactForm() {
    $contact= new contact();
    $form =  $this->createFormBuilder($contact)
        ->add('name')
        ->add('email')
        ->getform();
  return $this->render('contact/contact.html.twig',['contactform' => $form->createView()]);
}
}