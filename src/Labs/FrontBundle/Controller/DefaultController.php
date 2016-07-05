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


    public function getDossierAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dossier = $em->getRepository('LabsBackBundle:Dossier')->findBy(array(
            'online' => true
        ));
        return $this->render('LabsFrontBundle:Include:header.html.twig', array(
            'dossiers' => $dossier
        ));
    }

    public function getDossierGlobalAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dossier = $em->getRepository('LabsBackBundle:Dossier')->findBy(array(
            'online' => true
        ));
        return $this->render('LabsFrontBundle:Include:header-global.html.twig', array(
            'dossiers' => $dossier
        ));
    }
}
