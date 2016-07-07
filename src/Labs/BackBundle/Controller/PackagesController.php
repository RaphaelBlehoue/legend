<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Packages;
use Labs\BackBundle\Form\PackagesType;
use Labs\BackBundle\Form\PackagesEditType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PackagesController
 * @package Labs\BackBundle\Controller
 * @Route("/packages")
 */
class PackagesController extends Controller
{
    /**
     * @Route("/", name="package_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $packs = $em->getRepository('LabsBackBundle:Packages')->findAll();
        return $this->render('LabsBackBundle:Packages:index.html.twig', array(
            'packs' => $packs
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/create", name="package_create")
     */
    public function CreateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $packs = new Packages();
        $form = $this->createForm(PackagesType::class, $packs);
        $form->handleRequest($request);

            if($form->isValid()){
                $color = $request->request->get('_color');
                $packs->setColor($color);
                $em->persist($packs);
                $em->flush();
                $this->addFlash('success', 'L\'enregistrement  a été fait avec succès');
                return $this->redirectToRoute('package_index', array(), 302);
            }
        return $this->render('LabsBackBundle:Packages:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Packages $pack
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/edit", name="package_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Packages $pack, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $packs = $em->getRepository('LabsBackBundle:Packages')->find($pack);
        if(null === $packs)
        {
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        }
        $form = $this->createForm(PackagesEditType::class, $packs);
        $form->handleRequest($request);

        if($form->isValid()){
            $color = $request->request->get('_color');
            $packs->setColor($color);
            $em->flush();
            $this->addFlash('success', 'La modification a été fait avec succès');
            return $this->redirectToRoute('package_index', array(), 302);
        }

        return $this->render('LabsBackBundle:Packages:edit.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Packages $pack
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/delete", name="package_delete")
     * @Method("GET")
     */
    public function deleteAction(Packages $pack)
    {
        $em = $this->getDoctrine()->getManager();
        $packs = $em->getRepository('LabsBackBundle:Packages')->find($pack);
        if(null === $packs)
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        else
            $em->remove($packs);
            $em->flush();
            $this->addFlash('success', 'La suppression a été fait avec succès');
            return $this->redirectToRoute('package_index', array(), 302);
    }
}
