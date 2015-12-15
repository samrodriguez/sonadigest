<?php

namespace SonodigestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Categoria controller.
 *
 * @Route("/admin/galeria")
 */
class GaleriaController extends Controller{
    
    /**
     * Lists all Categoria entities.
     *
     * @Route("/", name="admin_galeria")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
         return $this->render('SonodigestBundle:Galeria:galeria.html.twig');     
    }
}
