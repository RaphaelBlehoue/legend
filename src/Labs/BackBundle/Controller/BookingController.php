<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Booking;
use Labs\BackBundle\Form\BookingType;
use Labs\BackBundle\Form\BookingEditType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CategoryController
 * @package Labs\BackBundle\Controller
 * @Route("/reservation")
 */
class BookingController extends Controller
{
    /**
     * @Route("/", name="booking_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $bookings = $em->getRepository('LabsBackBundle:Booking')->findAll();
        return $this->render('LabsBackBundle:Booking:index.html.twig', array(
            'bookings' => $bookings
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/create", name="booking_create")
     */
    public function CreateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

            if($form->isValid()){
                $em->persist($booking);
                $em->flush();
                $this->addFlash('success', 'L\'enregistrement  a été fait avec succès');
                return $this->redirectToRoute('booking_index', array(), 302);
            }
        return $this->render('LabsBackBundle:Booking:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Booking $booking
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/edit", name="booking_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Booking $booking, Request $request)
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
    }

    /**
     * @param Booking $booking
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/delete", name="booking_delete")
     * @Method("GET")
     */
    public function deleteAction(Booking $booking)
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
    }
}
