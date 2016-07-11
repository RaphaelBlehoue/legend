<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Packpage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Labs\BackBundle\Form\PackpageType;
use Labs\BackBundle\Form\PackpageEditType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PackpageController
 * @package Labs\BackBundle\Controller
 * @Route("/packpage")
 */
class PackpageController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/add", name="packpage_add")
     */
    public function PackpageAddAction(Request $request)
    {
        $data = new Packpage();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(PackpageType::class, $data);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em->persist($data);
            $em->flush();
            return $this->redirect($this->generateUrl('packpage_list'));
        }
        return $this->render('LabsBackBundle:Packpage:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("list", name="packpage_list")
     */
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('LabsBackBundle:Packpage')->findAll();
        return $this->render('LabsBackBundle:Packpage:index.html.twig', array(
            'packpages' => $data
        ));
    }

    /**
     * @param Packpage $packpage
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws NotFoundHttpException
     * @Route("/edit/{id}", name="packpage_edit",requirements={"id" = "\d+"})
     */
    public  function PackpageEditAction(Packpage $packpage, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if(null === $packpage){
            throw new NotFoundHttpException("L'element d'id ".$packpage." n'existe pas");
        }
        $form = $this->createForm(PackpageEditType::class, $packpage);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em->flush();
            return $this->redirectToRoute('packpage_list');
        }
        return $this->render('LabsBackBundle:Packpage:edit.html.twig',array(
            'form' => $form->createView()
        ));
    }


    /**
     * @param Packpage $packpage
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws NotFoundHttpException
     * @Route("/delete/{id}", name="packpage_delete", requirements={"id" = "\d+"})
     */
    public function PackpagedeleteAction(Packpage $packpage)
    {
        $em = $this->getDoctrine()->getManager();
        if( null === $packpage)
            throw new NotFoundHttpException('La banner '.$packpage.' n\'existe pas');
        else
            $em->remove($packpage);
        $em->flush();
        return $this->redirectToRoute('packpage_list');
    }
}
