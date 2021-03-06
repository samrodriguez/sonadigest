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
 * @Route("/contacto")
 */
class ContactoController extends Controller{
    
    /**
     * Lists all Categoria entities.
     *
     * @Route("/", name="admin_contacto")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
         return $this->render('SonodigestBundle:Contacto:contacto.html.twig');     
    }
}
