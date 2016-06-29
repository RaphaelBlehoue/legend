<?php

namespace Labs\BackBundle\Controller;

use Labs\BackBundle\Entity\Category;
use Labs\BackBundle\Form\CategoryType;
use Labs\BackBundle\Form\CategoryEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CategoryController
 * @package Labs\BackBundle\Controller
 * @Route("/catgory")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/", name="category_index")
     */
    public function indexAction()
    {
        return $this->render('LabsBackBundle:Category:index.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/create", name="category_create")
     */
    public function CreateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = new Category();
        $form = $this->createForm(CategoryType::class, $categorie);
        $form->handleRequest($request);

            if($form->isValid()){
                dump($form->getData()); die;
            }

        return $this->render('LabsBackBundle:Category:create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    public function editAction()
    {

    }
}
