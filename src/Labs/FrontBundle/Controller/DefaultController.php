<?php

namespace Labs\FrontBundle\Controller;

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
        $best = $this->findBestManAndWomen($dossier);
        dump($best);
        return $this->render('LabsFrontBundle:Default:wedding_view.html.twig',[
            'slides' => $slides,
            'galeries' => $gallery,
            'best'     => $best
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
     * @param Dossier $dossier
     * @return mixed
     * Retour tous les bests man et woment du dossier
     */
    private function findBestManAndWomen(Dossier $dossier)
    {
        $em = $this->getDoctrine()->getManager();
        $data = [];
        $result = [];
        $best = $em->getRepository('LabsBackBundle:Best')->getBestByDossier($dossier);
        foreach ( $best as $k => $b) {
            if($b->getGenre() == true){
                $data[$k] =[
                     'men' => $b
                ];
            }else{
                $data[$k] =[
                    'women' => $b
                ];
            }
            $result = array_merge($data);
        }
        return $result;
    }



}
