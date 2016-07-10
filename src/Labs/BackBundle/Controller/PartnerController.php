<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Partner;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Labs\BackBundle\Form\PartnerType;
use Labs\BackBundle\Form\PartnerEditType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PartnerController
 * @package Labs\BackBundle\Controller
 * @Route("/partner")
 */
class PartnerController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/add", name="partner_add")
     */
    public function UploadAction(Request $request)
    {
        $partner = new Partner();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em->persist($partner);
            $em->flush();
            return $this->redirect($this->generateUrl('partner_list'));
        }
        return $this->render('LabsBackBundle:Partner:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("list", name="partner_list")
     */
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        $partner = $em->getRepository('LabsBackBundle:Partner')->findAll();
        return $this->render('LabsBackBundle:Partner:index.html.twig', array(
            'partners' => $partner
        ));
    }

    /**
     * @param Partner $partner
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws NotFoundHttpException
     * @Route("/edit/{id}", name="partner_edit",requirements={"id" = "\d+"})
     */
    public  function PartnerEditAction(Partner $partner, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if(null === $partner){
            throw new NotFoundHttpException("L'element d'id ".$partner." n'existe pas");
        }
        $form = $this->createForm(PartnerEditType::class, $partner);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em->flush();
            return $this->redirectToRoute('partner_list');
        }
        return $this->render('LabsBackBundle:Partner:edit.html.twig',array(
            'form' => $form->createView()
        ));
    }


    /**
     * @param Partner $partner
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws NotFoundHttpException
     * @Route("/delete/{id}", name="partner_delete", requirements={"id" = "\d+"})
     */
    public function PartnerdeleteAction(Partner $partner)
    {
        $em = $this->getDoctrine()->getManager();
        if( null === $partner)
            throw new NotFoundHttpException('La banner '.$partner.' n\'existe pas');
        else
            $em->remove($partner);
        $em->flush();
        return $this->redirectToRoute('partner_list');
    }
}
