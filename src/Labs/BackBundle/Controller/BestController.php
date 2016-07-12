<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Best;
use Labs\BackBundle\Entity\Dossier;
use Labs\BackBundle\Form\BestType;
use Labs\BackBundle\Form\BestEditType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class BestController
 * @package Labs\BackBundle\Controller
 * @Route("/best/men_and_women")
 */
class BestController extends Controller
{
    /**
     * @Route("/", name="best_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $bests = $em->getRepository('LabsBackBundle:Best')->findAll();
        return $this->render('LabsBackBundle:Bests:index.html.twig', array(
            'bests' => $bests
        ));
    }

    /**
     * @param Request $request
     * @param Dossier $dossier
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/create/{id}", name="best_create")
     */
    public function CreateAction(Request $request, Dossier $dossier)
    {
        $em = $this->getDoctrine()->getManager();
        $best = new Best();
        $form = $this->createForm(BestType::class, $best);
        $dossiers = $em->getRepository('LabsBackBundle:Dossier')->find($dossier);
        $form->handleRequest($request);
            if($form->isValid()){
                $best->setDossier($dossier);
                $em->persist($best);
                $em->flush();
                $this->addFlash('success', 'L\'enregistrement  a été fait avec succès');
                return $this->redirectToRoute('best_create', ['id' => $best->getDossier()->getId()], 302);
            }
        return $this->render('LabsBackBundle:Bests:create.html.twig',array(
            'form' => $form->createView(),
            'dossier' => $dossiers
        ));
    }

    /**
     * @param Best $best
     * @param Dossier $dossier
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/{dossier}/edit", name="best_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Best $best, Dossier $dossier ,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if(null === $best)
        {
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        }
        $form = $this->createForm(BestEditType::class, $best);
        $form->handleRequest($request);

        if($form->isValid()){
            $em->flush();
            $this->addFlash('success', 'La modification a été effectué');
            return $this->redirectToRoute('dossier_view',['id' => $dossier->getId()], 302);
        }
        return $this->render('LabsBackBundle:Bests:edit.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Best $best
     * @param Dossier $dossier
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/delete", name="best_delete")
     * @Method("GET")
     */
    public function deleteAction(Best $best, Dossier $dossier, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if(null === $best)
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        else
            $em->remove($best);
            $em->flush();
            $this->addFlash('success', 'La suppression a été fait avec succès');
            return $this->redirectToRoute('dossier_view',['id' => $dossier->getId()], 302);
    }

}
