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
 * @Route("/admin/fotos")
 */
class FotosController extends Controller{
    
    /**
     * Lists all Categoria entities.
     *
     * @Route("/", name="admin_fotos")
     * @Method("GET")
     * @Template("SonodigestBundle:Galeria:galeriafotos.html.twig")
     */
    public function indexAction()
    {
        return array();     
    }
}
