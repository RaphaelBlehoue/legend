<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Media;
use Labs\BackBundle\Entity\Dossier;
use Labs\BackBundle\Entity\Type;
use Labs\BackBundle\Form\MediaType;
use Labs\BackBundle\Form\MediaEditType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class MediaController
 * @package Labs\BackBundle\Controller
 * @Route("/Media/gallery")
 */
class MediaController extends Controller
{
    /**
     * @Route("/", name="media_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $medias = $em->getRepository('LabsBackBundle:Media')->findAll();
        return $this->render('LabsBackBundle:Medias:index.html.twig', array(
            'medias' => $medias
        ));
    }

    /**
     * @param Request $request
     * @param Dossier $dossier
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/create/{id}", name="media_create")
     */
    public function CreateAction(Request $request, Dossier $dossier)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(MediaType::class);
        $form->handleRequest($request);
            if($form->isValid()){
                $type_array = $request->request->all();

                $type = $em->getRepository('LabsBackBundle:Type')->getOne($type_array['media']['type']);
                $dossier = $em->getRepository('LabsBackBundle:Dossier')->getOne($dossier);
                return $this->redirectToRoute('media_add', ['dossier' => $dossier->getId() ,  'type' => $type->getId()], 302);
            }
        return $this->render('LabsBackBundle:Medias:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param Dossier $dossier
     * @param Type $type
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/add/{dossier}/{type}", name="media_add")
     */
    public function AddAction(Request $request, Dossier $dossier, Type $type)
    {

        $em = $this->getDoctrine()->getManager();
        return $this->render('LabsBackBundle:Medias:upload.html.twig');
    }

    /**
     * @param Booking $booking
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/edit", name="booking_edit")
     * @Method({"GET", "POST"})
     */
   /* public function editAction(Booking $booking, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $bookings = $em->getRepository('LabsBackBundle:Booking')->getOne($booking);
        if(null === $bookings)
        {
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        }
        $form = $this->createForm(BookingEditType::class, $bookings);
        $form->handleRequest($request);

        if($form->isValid()){
            $em->flush();
            $this->addFlash('success', 'La modification a été effectué');
            return $this->redirectToRoute('booking_index', array(), 302);
        }
        return $this->render('LabsBackBundle:Booking:edit.html.twig',array(
            'form' => $form->createView()
        ));
    } */

    /**
     * @param Booking $booking
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/delete", name="booking_delete")
     * @Method("GET")
     */
    /*public function deleteAction(Booking $booking)
    {
        $em = $this->getDoctrine()->getManager();
        $bookings = $em->getRepository('LabsBackBundle:Booking')->find($booking);
        if(null === $bookings)
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        else
            $em->remove($bookings);
            $em->flush();
            $this->addFlash('success', 'La suppression a été fait avec succès');
            return $this->redirectToRoute('booking_index', array(), 302);
    }*/
}
