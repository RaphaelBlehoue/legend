<?php

namespace Labs\FrontBundle\Controller;

use Labs\BackBundle\Entity\Category;
use Labs\BackBundle\Entity\Events;
use Labs\BackBundle\Entity\Packs;
use Labs\BackBundle\Entity\Type;
use Labs\BackBundle\Entity\Dossier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


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
        $page  = $this->getInfoPagePackage();
        return $this->render('LabsFrontBundle:Default:index.html.twig',[
            'about' => $about,
            'packs' => $packs,
            'dossiers' => $dossiers,
            'events'   => $events,
            'partners' => $partners,
            'citations' => $citations,
            'page'      => $page
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/about-us", name="about")
     */
    public function AboutAction(){
        $about = $this->getAboutContent();
        $partners = $this->getAllPartners();
        $citations = $this->findTemoignage();
        return $this->render('LabsFrontBundle:Default:about_us.html.twig',[
            'about' => $about,
            'partners' => $partners,
            'citations' => $citations
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/nos-packages", name="pack")
     */
    public function PackPageAction()
    {
        $packs = $this->getPacksList();
        $partners = $this->getAllPartners();
        $citations = $this->findTemoignage();
        $page  = $this->getInfoPagePackage();
        return $this->render('LabsFrontBundle:Default:pack.html.twig',[
            'partners' => $partners,
            'packs' => $packs,
            'citations' => $citations,
            'page'      => $page
        ]);
    }

    /**
 * @param Packs $packs
 * @param $slug
 * @return \Symfony\Component\HttpFoundation\Response
 * @Route("/nos-packages/{id}_{slug}", name="pack_view_list")
 */
    public function PackPageViewAction( Packs $packs, $slug )
    {
        $packs = $this->getPacksAndPackageList($packs);
        $partners = $this->getAllPartners();
        $citations = $this->findTemoignage();
        $page  = $this->getInfoPagePackage();
        return $this->render('LabsFrontBundle:Default:pack_view.html.twig',[
            'partners' => $partners,
            'packs' => $packs,
            'citations' => $citations,
            'page'      => $page
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/page/wedding/", name="wedding")
     */
    public function WeddingPageAction()
    {
        $partners = $this->getAllPartners();
        $weddingByType = $this->getMediaByTypeWedding(true, 3);
        $slides = $this->getSlideWedding(3);
        return $this->render('LabsFrontBundle:Default:wedding.html.twig',[
            'partners'      => $partners,
            'TypeWeddings'  => $weddingByType,
            'slides'        => $slides
        ]);
    }

    /**
     * @param Type $type
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/page/wedding/{id}/{slug}", name="wedding_type")
     */
    public function WeddingTypePageAction( Type $type, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $findmedias = $em->getRepository('LabsBackBundle:Media')->findLastMediaLimit($type);
        $medias  = $this->get('knp_paginator')->paginate(
            $findmedias,
            $request->query->getInt('page', 1), 9);
        $medias->setTemplate('LabsFrontBundle:Pagination:paginate.html.twig');
        return $this->render('LabsFrontBundle:Default:wedding_type.html.twig',[
            'type'   => $type,
            'medias' => $medias
        ]);
    }

    /**
     * @param Dossier $dossier
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("{id}/wedding/{slug}", name="wedding_view")
     */
    public function WeddingPageViewAction(Dossier $dossier, $slug)
    {
        $slides = $this->getSlideWeddingViewPage($dossier);
        $gallery = $this->findMediaByDossier($dossier);
        $bests = $this->findBestManAndWomen($dossier);
        return $this->render('LabsFrontBundle:Default:wedding_view.html.twig',[
            'slides' => $slides,
            'galeries' => $gallery,
            'bests'     => $bests
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/page/events", name="event_page")
     */
    public function getPageEventsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $partners = $this->getAllPartners();
        $citations = $this->findTemoignage();
        $events = $em->getRepository('LabsBackBundle:Events')->findEvents();
        $slides = $em->getRepository('LabsBackBundle:Media')->findSlideEvents(6);
        return $this->render('LabsFrontBundle:Default:event_page.html.twig',[
            'events'   => $events,
            'slides'   => $slides,
            'citations' => $citations,
            'partners' => $partners
        ]);
    }

    /**
     * @param Category $category
     * @param $slug
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/events/type/{id}_{slug}", name="page_event_type")
     */
    public function getPageEventsTypeAction(Category $category, $slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $events = $this->findAllEventCategory($category);
        $findmedias = $em->getRepository('LabsBackBundle:Media')->findLastMediaEventsLimit($events);
        $data  = $this->get('knp_paginator')->paginate(
            $findmedias,
            $request->query->getInt('page', 1), 9);
        $data->setTemplate('LabsFrontBundle:Pagination:paginate.html.twig');
        return $this->render('LabsFrontBundle:Default:event_page_type.html.twig',[
            'events' => $data,
            'categories' => $category
        ]);
    }

    /**
     * @param Events $events
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/events/{id}/{slug}", name="page_event_view")
     */
    public function getPageEventsViewAction(Events $events, $slug)
    {
        $slides = $this->getSlideEventViewPage($events);
        $gallery = $this->findMediaByEvents($events);
        dump($gallery);
        return $this->render('LabsFrontBundle:Default:event_page_view.html.twig',[
            'slides' => $slides,
            'galeries' => $gallery
        ]);
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

    /**
     * @param $id
     * @return mixed
     */
    private function getPacksAndPackageList($id)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('LabsBackBundle:Packs')->findPackAndPackage($id);
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

    /**
     * @return array|\Labs\BackBundle\Entity\Citation[]
     * Recherche tous les temoignages
     */
    private function findTemoignage()
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('LabsBackBundle:Citation')->findAll();
        return $data; 
    }

    /**
     * @return mixed
     * Page package information
     */
    private function getInfoPagePackage()
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('LabsBackBundle:Packpage')->getOne();
        return $data;
    }


    /**
     * @param bool|false $typeCode
     * @param null $num
     * @return array
     */
    private function getMediaByTypeWedding($typeCode = false, $num = null)
    {
        $em = $this->getDoctrine()->getManager();
        $media = [];
        if(true === $typeCode){
            $type = [];
            $data = $em->getRepository('LabsBackBundle:Type')->findAll();
            foreach ( $data as $d ) {
                $type[] = $d->getId();
            }
            foreach ( $type as $k => $t ) {
                $findType = $em->getRepository('LabsBackBundle:Type')->find($t);
                $media[$t] =[
                    'name' => $findType->getName(),
                    'gallery' => $em->getRepository('LabsBackBundle:Media')->findLastMediaLimit($findType, $num)
                ];
            }
        }else{
            $media = $em->getRepository('LabsBackBundle:Media')->findLastMediaLimit();
        }
        return $media;
    }

    /**
     * @param null $num
     * @return array
     * recuperation des medias a la une global en fonction des paramètres
     */
    private function getSlideWedding($num = null)
    {
        $em = $this->getDoctrine()->getManager();
        $data = [];
        $dossier = $em->getRepository('LabsBackBundle:Dossier')->findAll();
        foreach ( $dossier as  $d) {
            $data[] = $d->getId();
        }
        if(null !== $num)
            $media = $em->getRepository('LabsBackBundle:Media')->findLastMedia($data, $num);
        else
            $media = $em->getRepository('LabsBackBundle:Media')->findLastMedia($dossier);

        return $media;
    }

    /**
     * @param $dossier
     * @return mixed
     * Recuperation du slide de la page wedding
     */
    private function getSlideWeddingViewPage($dossier)
    {
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('LabsBackBundle:Media')->findSlideMedia($dossier);
        return $media;
    }

    /**
     * @param $event
     * @return mixed
     * Recuperation du slide de la page events
     */
    public function getSlideEventViewPage($event)
    {
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('LabsBackBundle:Media')->findAllSlideMedia($event);
        return $media;
    }


    /**
     * @param Dossier $dossier
     * @return array
     */
    private function findMediaByDossier(Dossier $dossier)
    {
        $em = $this->getDoctrine()->getManager();
        $galleries = $em->getRepository('LabsBackBundle:Type')->findMediaGroupBy($dossier);
        return $galleries;
    }

    /**
     * @param Events $events
     * @return array
     */
    private function findMediaByEvents(Events $events)
    {
        $em = $this->getDoctrine()->getManager();
        $galleries = $em->getRepository('LabsBackBundle:Events')->findMediaGroupBy($events);
        return $galleries;
    }

    /**
     * @param Dossier $dossier
     * @return mixed
     * Retour tous les bests man et woment du dossier
     */
    private function findBestManAndWomen(Dossier $dossier)
    {
        $em = $this->getDoctrine()->getManager();
        $best = $em->getRepository('LabsBackBundle:Best')->getBestByDossier($dossier);
        return $best;
    }

    /**
     * @param Category $category
     * @return mixed
     * Recherche tous les evenements de cette categorie
     */
    private function findAllEventCategory(Category $category)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('LabsBackBundle:Events')->findAllEvents($category);
        return $data;
    }

}
