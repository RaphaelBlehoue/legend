<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Dossier;
use Labs\BackBundle\Form\DossierType;
use Labs\BackBundle\Form\DossierEditType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class DossierController
 * @package Labs\BackBundle\Controller
 * @Route("/wedding/folder")
 */
class DossierController extends Controller
{
    /**
     * @Route("/", name="dossier_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dossiers = $em->getRepository('LabsBackBundle:Dossier')->findAll();
        return $this->render('LabsBackBundle:Dossiers:index.html.twig', array(
            'dossiers' => $dossiers
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/create", name="dossier_create")
     */
    public function CreateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dossier = new Dossier();
        $form = $this->createForm(DossierType::class, $dossier);
        $form->handleRequest($request);

            if($form->isValid()){
                $color = $request->request->get('_color');
                $dossier->setColors($color);
                $em->persist($dossier);
                $em->flush();
                $this->addFlash('success', 'L\'enregistrement  a été fait avec succès');
                return $this->redirectToRoute('best_create',['id' => $dossier->getId()], 302);
            }
        return $this->render('LabsBackBundle:Dossiers:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Dossier $dossier
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/edit", name="dossier_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Dossier $dossier, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dossiers = $em->getRepository('LabsBackBundle:Dossier')->find($dossier);
        if(null === $dossiers)
        {
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        }
        $form = $this->createForm(DossierEditType::class, $dossiers);
        $form->handleRequest($request);

        if($form->isValid()){
            $em->flush();
            $this->addFlash('success', 'La modification a été effectué');
            return $this->redirectToRoute('dossier_index', array(), 302);
        }
        return $this->render('LabsBackBundle:Dossiers:edit.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Dossier $dossier
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/delete", name="dossier_delete")
     * @Method("GET")
     */
    public function deleteAction(Dossier $dossier)
    {
        $em = $this->getDoctrine()->getManager();
        $dossiers = $em->getRepository('LabsBackBundle:Dossier')->find($dossier);
        if(null === $dossiers)
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        else
            $em->remove($dossiers);
            $em->flush();
            $this->addFlash('success', 'La suppression a été fait avec succès');
            return $this->redirectToRoute('dossier_index', array(), 302);
    }
}
