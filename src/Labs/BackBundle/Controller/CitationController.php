<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Citation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Labs\BackBundle\Form\CitationType;
use Labs\BackBundle\Form\CitationEditType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CitationController
 * @package Labs\BackBundle\Controller
 * @Route("/citation")
 */
class CitationController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/add", name="citation_add")
     */
    public function UploadAction(Request $request)
    {
        $citation = new Citation();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(CitationType::class, $citation);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em->persist($citation);
            $em->flush();
            return $this->redirect($this->generateUrl('citation_list'));
        }
        return $this->render('LabsBackBundle:Citation:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("list", name="citation_list")
     */
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        $citation = $em->getRepository('LabsBackBundle:Citation')->findAll();
        return $this->render('LabsBackBundle:Citation:index.html.twig', array(
            'citations' => $citation
        ));
    }

    /**
     * @param Citation $citation
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws NotFoundHttpException
     * @Route("/edit/{id}", name="citation_edit",requirements={"id" = "\d+"})
     */
    public  function PartnerEditAction(Citation $citation, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if(null === $citation){
            throw new NotFoundHttpException("L'element d'id ".$citation." n'existe pas");
        }
        $form = $this->createForm(CitationEditType::class, $citation);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em->flush();
            return $this->redirectToRoute('citation_list');
        }
        return $this->render('LabsBackBundle:Citation:edit.html.twig',array(
            'form' => $form->createView()
        ));
    }


    /**
     * @param Citation $citation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws NotFoundHttpException
     * @Route("/delete/{id}", name="citation_delete", requirements={"id" = "\d+"})
     */
    public function CitationdeleteAction(Citation $citation)
    {
        $em = $this->getDoctrine()->getManager();
        if( null === $citation)
            throw new NotFoundHttpException('La citation '.$citation.' n\'existe pas');
        else
            $em->remove($citation);
        $em->flush();
        return $this->redirectToRoute('citation_list');
    }
}
