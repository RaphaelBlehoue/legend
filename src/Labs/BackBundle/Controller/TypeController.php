<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Type;
use Labs\BackBundle\Form\TypeType;
use Labs\BackBundle\Form\TypeEditType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class TypeController
 * @package Labs\BackBundle\Controller
 * @Route("/event")
 */
class TypeController extends Controller
{
    /**
     * @Route("/", name="type_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $types = $em->getRepository('LabsBackBundle:Type')->findAll();
        return $this->render('LabsBackBundle:Types:index.html.twig', array(
            'types' => $types
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/create", name="type_create")
     */
    public function CreateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $types = new Type();
        $form = $this->createForm(TypeType::class, $types);
        $form->handleRequest($request);

            if($form->isValid()){
                $em->persist($types);
                $em->flush();
                $this->addFlash('success', 'L\'enregistrement  a été fait avec succès');
                return $this->redirectToRoute('type_index', array(), 302);
            }
        return $this->render('LabsBackBundle:Types:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Type $type
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}/edit", name="type_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Type $type, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $types = $em->getRepository('LabsBackBundle:Type')->getOne($type);
        if(null === $types)
        {
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        }
        $form = $this->createForm(TypeEditType::class, $types);
        $form->handleRequest($request);

        if($form->isValid()){
            $em->flush();
            $this->addFlash('success', 'La modification a été fait avec succès');
            return $this->redirectToRoute('type_index', array(), 302);
        }
        return $this->render('LabsBackBundle:Types:edit.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Type $type
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/delete", name="type_delete")
     * @Method("GET")
     */
    public function deleteAction(Type $type)
    {
        $em = $this->getDoctrine()->getManager();
        $types = $em->getRepository('LabsBackBundle:Type')->find($type);
        if(null === $types)
            throw new NotFoundHttpException('Page Introuvable',null, 404);
        else
            $em->remove($types);
            $em->flush();
            $this->addFlash('success', 'La suppression a été fait avec succès');
            return $this->redirectToRoute('type_index', array(), 302);
    }
}
