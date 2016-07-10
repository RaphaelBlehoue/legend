<?php

namespace Labs\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Class CategoryController
 * @package Labs\BackBundle\Controller
 * @Route("/admin")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render('LabsBackBundle:Default:index.html.twig');
    }

}
