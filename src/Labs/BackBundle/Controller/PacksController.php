<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Packs;
use Labs\BackBundle\Form\PacksType;
use Labs\BackBundle\Form\PacksEditType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PacksController
 * @package Labs\BackBundle\Controller
 * @Route("/packs")
 */
class PacksController extends Controller
{
    /**
     * @Route("/", name="packs_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $packs = $em->getRepository('LabsBackBundle:Packs')->findAll();
        return $this->render('LabsBackBundle:Packs:index.html.twig', array(
            'packs' => $packs
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/create", name="packs_create")
     */
    public function CreateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $packs = new Packs();
        $form = $this->createForm(PacksType::class, $packs);
        $form->handleRequest($request);

            if($form->isValid()){
                $color = $request->request->get('_color');
                $packs->setColor($color);
                $em->persist($packs);
                $em->flush();
                $this->addFlash('success', 'L\'enregistrement  a été fait avec succès');
                return $this->redirectToRoute('packs_index', array(), 302);
            }
        return $this->render('LabsBackBundle:Packs:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Packs $pack
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/edit", name="packs_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Packs $pack, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $packs = $em->getRepository('LabsBackBundle:Packs')->getOne($pack);
        if(null === $packs)
        {
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        }
        $form = $this->createForm(PacksEditType::class, $packs);
        $form->handleRequest($request);

        if($form->isValid()){
            $color = $request->request->get('_color');
            $packs->setColor($color);
            $em->flush();
            $this->addFlash('success', 'La modification a été fait avec succès');
            return $this->redirectToRoute('packs_index', array(), 302);
        }
        return $this->render('LabsBackBundle:Packs:edit.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Packs $pack
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/delete", name="packs_delete")
     * @Method("GET")
     */
    public function deleteAction(Packs $pack)
    {
        $em = $this->getDoctrine()->getManager();
        $packs = $em->getRepository('LabsBackBundle:Packs')->find($pack);
        if(null === $packs)
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        else
            $em->remove($packs);
            $em->flush();
            $this->addFlash('success', 'La suppression a été fait avec succès');
            return $this->redirectToRoute('packs_index', array(), 302);
    }
}
