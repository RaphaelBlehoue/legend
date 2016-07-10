<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\About;
use Labs\BackBundle\Entity\BannerImage;
use Labs\BackBundle\Form\AboutType;
use Labs\BackBundle\Form\AboutEditType;
use Labs\BackBundle\Form\BannerImageEditType;
use Labs\BackBundle\Form\BannerImageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PagesController
 * @package Labs\BackBundle\Controller
 * @Route("/pages")
 */
class PagesController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/about/add", name="about_add")
     */
    public function AboutAddAction(Request $request)
    {
        $about = new About();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em->persist($about);
            $em->flush();
            return $this->redirect($this->generateUrl('about_list'));
        }
        return $this->render('LabsBackBundle:Pages:about_add.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/about/list", name="about_list")
     */
    public function AboutlistAction(){
        $em = $this->getDoctrine()->getManager();
        $about = $em->getRepository('LabsBackBundle:About')->findAll();
        return $this->render('LabsBackBundle:Pages:about_index.html.twig', array(
            'abouts' => $about
        ));
    }

    /**
     * @param About $about
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws NotFoundHttpException
     * @Route("/about/edit/{id}", name="about_edit",requirements={"id" = "\d+"})
     */
    public  function AboutEditAction(About $about, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $abouts = $em->getRepository('LabsBackBundle:About')->find($about);
        if(null === $abouts){
            throw new NotFoundHttpException("L'element d'id ".$abouts." n'existe pas");
        }
        $form = $this->createForm(AboutEditType::class, $abouts);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em->flush();
            return $this->redirectToRoute('about_list');
        }
        return $this->render('LabsBackBundle:Pages:about_edit.html.twig',array(
            'form' => $form->createView()
        ));
    }


    /**
     * @param About $about
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws NotFoundHttpException
     * @Route("/about/delete/{id}", name="about_delete", requirements={"id" = "\d+"})
     */
    public function AboutdeleteAction(About $about)
    {
        $em = $this->getDoctrine()->getManager();
        $abouts = $em->getRepository('LabsBackBundle:About')->find($about);
        if( null === $abouts)
            throw new NotFoundHttpException('La pages '.$abouts.' n\'existe pas');
        else
            $em->remove($abouts);
        $em->flush();
        return $this->redirectToRoute('about_list');
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/banner/add", name="page_banner_add")
     */
    public function UploadBannerIamgeAction(Request $request)
    {
        $banner = new BannerImage();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(BannerImageType::class, $banner);
        $form->handleRequest($request);
        if($form->isValid())
        {
            //$color = $request->request->get('_color');
            //$banner->setTextColor($color);
            $em->persist($banner);
            $em->flush();
            return $this->redirect($this->generateUrl('banner_image_list'));
        }
        return $this->render('LabsBackBundle:BannerImage:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/banner/list", name="banner_image_list")
     */
    public function BannerlistAction(){
        $em = $this->getDoctrine()->getManager();
        $banner = $em->getRepository('LabsBackBundle:BannerImage')->findAll();
        return $this->render('LabsBackBundle:BannerImage:index.html.twig', array(
            'banners' => $banner
        ));
    }

    /**
     * @param BannerImage $banner
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws NotFoundHttpException
     * @Route("/banner/edit/{id}", name="banner_image_edit",requirements={"id" = "\d+"})
     */
    public  function bannerEditAction(BannerImage $banner, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        // On recupere l'id du market
        $banners = $em->getRepository('LabsBackBundle:BannerImage')->find($banner);
        if(null === $banners){
            throw new NotFoundHttpException("L'element d'id ".$banners." n'existe pas");
        }
        $form = $this->createForm(BannerImageEditType::class, $banners);
        $form->handleRequest($request);
        if($form->isValid())
        {
            //$color = $request->request->get('_color');
            //$banner->setTextColor($color);
            $em->flush();
            return $this->redirectToRoute('banner_image_list');
        }
        return $this->render('LabsBackBundle:BannerImage:edit.html.twig',array(
            'form' => $form->createView()
        ));
    }


    /**
     * @param BannerImage $banner
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws NotFoundHttpException
     * @Route("/banner/delete/{id}", name="banner_image_delete", requirements={"id" = "\d+"})
     */
    public function BannerdeleteAction(BannerImage $banner)
    {
        $em = $this->getDoctrine()->getManager();
        $banners = $em->getRepository('LabsBackBundle:BannerImage')->find($banner);
        if( null === $banners)
            throw new NotFoundHttpException('La banner '.$banners.' n\'existe pas');
        else
            $em->remove($banners);
        $em->flush();
        return $this->redirectToRoute('banner_image_list');
    }
}
