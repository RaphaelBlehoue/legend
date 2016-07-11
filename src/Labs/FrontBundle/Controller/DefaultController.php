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
        $about = $this->getAboutContent();
        $packs = $this->getPacksList();
        $dossiers = $this->getMediaTop();
        $events = $this->getEventListLimited(6);
        $partners = $this->getAllPartners();
        $citations = $this->findTemoignage();
        return $this->render('LabsFrontBundle:Default:index.html.twig',[
            'about' => $about,
            'packs' => $packs,
            'dossiers' => $dossiers,
            'events'   => $events,
            'partners' => $partners,
            'citations' => $citations
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/about-us", name="about")
     */
    public function AboutAction(){
        return $this->render('LabsFrontBundle:Default:about_us.html.twig');
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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @return mixed
     * Retour les contentes de la page About
     */
    private function getAboutContent()
    {
        $em = $this->getDoctrine()->getManager();
        $about = $em->getRepository('LabsBackBundle:About')->findOnePage();
        return $about;
    }

    /**
     * @return array|\Labs\BackBundle\Entity\Packs[]
     */
    private function getPacksList()
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('LabsBackBundle:Packs')->findAll();
        return $data;
    }


    private function getMediaTop($num = null)
    {
        $em = $this->getDoctrine()->getManager();
        $dossiers = [];
        if(null !== $num)
            $dossier = $em->getRepository('LabsBackBundle:Dossier')->findDossierLimit($num);
        else
            $dossier = $em->getRepository('LabsBackBundle:Dossier')->findDossierLimit();
        foreach ($dossier as $d ) {
            $dossiers[] = $d->getId();
        }
        $data = $em->getRepository('LabsBackBundle:Media')->findLastMedia($dossiers);
        return $data;
    }

    /**
     * @param null $num
     * @return array
     * Recupération de tous les evenements en fonction d'une limite
     */
    private  function getEventListLimited($num = null)
    {
        $em = $this->getDoctrine()->getManager();
        if(null !== $num)
            $data = $em->getRepository('LabsBackBundle:Events')->findEvents($num);
        else
            $data = $em->getRepository('LabsBackBundle:Events')->findEvents();
        return $data;
    }

    /**
     * @return array|\Labs\BackBundle\Entity\Partner[]
     * Retourne tous les partenaires
     */
    private function getAllPartners()
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('LabsBackBundle:Partner')->findAll();
        return $data;
    }
    
    private function findTemoignage()
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('LabsBackBundle:Citation')->findAll();
        return $data; 
    }


}
