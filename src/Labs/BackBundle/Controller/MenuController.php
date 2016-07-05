<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Labs\BackBundle\Form\MenuType;
use Labs\BackBundle\Form\MenuEditType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class MenuController
 * @package Labs\BackBundle\Controller
 * @Route("/menu")
 */
class MenuController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("add", name="menu_add")
     */
    public function AddMenuAction(Request $request)
    {
        $menu = new Menu();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em->persist($menu);
            $em->flush();
            return $this->redirect($this->generateUrl('menu_list'));
        }
        return $this->render('LabsBackBundle:Menus:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("list", name="menu_list")
     */
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        $menus = $em->getRepository('LabsBackBundle:Menu')->findAll();
        return $this->render('LabsBackBundle:Menus:index.html.twig', array(
            'menus' => $menus
        ));
    }

    /**
     * @param Menu $menu
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws NotFoundHttpException
     * @Route("{id}/edit", name="menu_edit",requirements={"id" = "\d+"})
     */
    public  function MenuEditAction(Menu $menu, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        // On recupere l'id du market
        $menus = $em->getRepository('LabsBackBundle:Menu')->find($menu);
        if(null === $menus){
            throw new NotFoundHttpException("L'element d'id ".$menus." n'existe pas");
        }
        $form = $this->createForm(MenuEditType::class, $menus);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em->flush();
            return $this->redirectToRoute('menu_list');
        }
        return $this->render('LabsBackBundle:Menus:edit.html.twig',array(
            'form' => $form->createView()
        ));
    }


    /**
     * @param Menu $menu
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws NotFoundHttpException
     * @Route("{id}/delete", name="menu_delete", requirements={"id" = "\d+"})
     */
    public function MenuDeleteAction(Menu $menu)
    {
        $em = $this->getDoctrine()->getManager();
        $menus = $em->getRepository('LabsBackBundle:Menu')->find($menu);
        if( null === $menus)
            throw new NotFoundHttpException('Le menu '.$menus.' n\'existe pas');
        else
            $em->remove($menus);
        $em->flush();
        return $this->redirectToRoute('menu_list');
    }
}
