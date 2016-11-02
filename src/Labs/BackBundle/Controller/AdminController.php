<?php

namespace Labs\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class AdminController extends Controller
{

    /**
     * @Route("/", name="index_admin")
     */
    public function indexAction()
    {
        return $this->render('LabsBackBundle:Admin:index.html.twig');
    }

}
