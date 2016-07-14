<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Contacts;
use Labs\BackBundle\Form\ContactsType;
use Labs\BackBundle\Form\ContactsEditType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ContactsController
 * @package Labs\BackBundle\Controller
 * @Route("/contacts")
 */
class ContactsController extends Controller
{
    /**
     * @Route("/", name="contact_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $contacts = $em->getRepository('LabsBackBundle:Contacts')->findAll();
        return $this->render('LabsBackBundle:Contacts:index.html.twig', array(
            'contacts' => $contacts
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/create", name="contact_create")
     */
    public function CreateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $contacts = new Contacts();
        $form = $this->createForm(ContactsType::class, $contacts);
        $form->handleRequest($request);
            if($form->isValid()){
                $em->persist($contacts);
                $em->flush();
                $this->addFlash('success', 'L\'enregistrement  a été fait avec succès');
                return $this->redirectToRoute('contact_index', array(), 302);
            }
        return $this->render('LabsBackBundle:Contacts:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Contacts $contacts
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/edit", name="contact_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Contacts $contacts, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $contact = $em->getRepository('LabsBackBundle:Category')->find($contacts);
        if(null === $contact)
        {
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        }
        $form = $this->createForm(ContactsEditType::class, $contact);
        $form->handleRequest($request);

        if($form->isValid()){
            $em->flush();
            $this->addFlash('success', 'La modification a été fait avec succès');
            return $this->redirectToRoute('contact_index', array(), 302);
        }
        return $this->render('LabsBackBundle:Contacts:edit.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Contacts $contact
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/delete", name="contact_delete")
     * @Method("GET")
     */
    public function deleteAction(Contacts $contact)
    {
        $em = $this->getDoctrine()->getManager();
        $contacts = $em->getRepository('LabsBackBundle:Category')->find($contact);
        if(null === $contacts)
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        else
            $em->remove($contacts);
            $em->flush();
            $this->addFlash('success', 'La suppression a été fait avec succès');
            return $this->redirectToRoute('contact_index', array(), 302);
    }
}
