<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Events;
use Labs\BackBundle\Form\EventsEditType;
use Labs\BackBundle\Form\EventsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class EventsController
 * @package Labs\BackBundle\Controller
 * @Route("/events/folder")
 */
class EventsController extends Controller
{
    /**
     * @Route("/", name="events_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('LabsBackBundle:Events')->findAll();
        return $this->render('LabsBackBundle:Events:index.html.twig', array(
            'events' => $events
        ));
    }

    /**
     * @param Events $event
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/view", name="event_view")
     * @Method({"GET", "POST"})
     */
    public function EventsViewAction( Events $event)
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('LabsBackBundle:Events')->getOneAndAssociation($event);
        if(null === $events)
        {
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        }
        return $this->render('LabsBackBundle:Events:event_view.html.twig',array(
            'event'  => $events
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/create", name="events_create")
     */
    public function CreateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = new Events();
        $form = $this->createForm(EventsType::class, $event);
        $form->handleRequest($request);

            if($form->isValid()){
                $em->persist($event);
                $em->flush();
                $this->addFlash('success', 'L\'enregistrement  a été fait avec succès');
                return $this->redirectToRoute('media_event_add',['id' => $event->getId()], 302);
            }
        return $this->render('LabsBackBundle:Events:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Events $events
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/edit", name="event_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Events $events, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if(null === $events)
        {
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        }
        $form = $this->createForm(EventsEditType::class, $events);
        $form->handleRequest($request);

        if($form->isValid()){
            $em->flush();
            $this->addFlash('success', 'La modification a été effectué');
            return $this->redirectToRoute('event_view',['id' => $events->getId()], 302);
        }
        return $this->render('LabsBackBundle:Events:edit.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param Events $events
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/online/{id}", name="event_online")
     */
    public function PostOnline(Request $request ,Events $events)
    {
        $em = $this->getDoctrine()->getManager();
        if(null === $events){
            throw  new NotFoundHttpException('Page introuvable');
        }
        if($request->isMethod('GET')){
            $events->setOnline(1);
            $em->flush();
            return $this->redirectToRoute('event_view', ['id' => $events->getId()], '302');
        }
    }

    /**
     * @param Events $events
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/delete", name="event_delete")
     * @Method("GET")
     */
    public function deleteAction(Events $events)
    {
        $em = $this->getDoctrine()->getManager();
        //$dossiers = $em->getRepository('LabsBackBundle:Events')->find($dossier);
        if(null === $events)
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        else
            $em->remove($events);
            $em->flush();
            $this->addFlash('success', 'La suppression a été fait avec succès');
            return $this->redirectToRoute('events_index', array(), 302);
    }
}
