<?php

namespace Labs\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function HomepageAction()
    {
        return $this->render('LabsFrontBundle:Default:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog", name="blog_page")
     */
    public function BlogControllerAction()
    {
        return $this->render('LabsFrontBundle:Blog:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/nous-contactez", name="contact_page")
     */
    public function ContactControllerAction()
    {
        return $this->render('LabsFrontBundle:Contact:contact.html.twig');
    }


    public function getSlideAction()
    {
        $em = $this->getDoctrine()->getManager();
        $slide = $em->getRepository('LabsBackBundle:Banner')->findBy(array(
            'online' => true
        ));
        return $this->render('LabsFrontBundle:Include:slide.html.twig', array(
            'slides' => $slide
        ));
    }


    public function getMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $type = $em->getRepository('LabsBackBundle:Type')->findBy(array(
            'top' => true
        ));

        $event = $em->getRepository('LabsBackBundle:Category')->findBy(array(
            'top' => true
        ));

        $pack = $em->getRepository('LabsBackBundle:Packs')->findBy(array(
            'online' => true
        ));

        return $this->render('LabsFrontBundle:Include:header.html.twig', array(
            'types' => $type,
            'events' => $event,
            'packs' => $pack
        ));
    }

    public function getMenuGlobalAction()
    {
        $em = $this->getDoctrine()->getManager();
        $type = $em->getRepository('LabsBackBundle:Type')->findBy(array(
            'top' => true
        ));

        $event = $em->getRepository('LabsBackBundle:Category')->findBy(array(
            'top' => true
        ));

        $pack = $em->getRepository('LabsBackBundle:Packs')->findBy(array(
            'online' => true
        ));

        return $this->render('LabsFrontBundle:Include:header-global.html.twig', array(
            'types' => $type,
            'events' => $event,
            'packs' => $pack
        ));
    }
}
