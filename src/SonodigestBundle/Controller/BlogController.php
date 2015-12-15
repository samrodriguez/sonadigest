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
 * @Route("/admin/blog")
 */
class BlogController extends Controller{
    
    /**
     * Lists all Categoria entities.
     *
     * @Route("/", name="admin_blog")
     * @Method("GET")
     * @Template("SonodigestBundle:Blog:blog.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $categoriasBlog = $em->getRepository('SonodigestBundle:Categoriablog')->findAll();
        $entradas = $em->getRepository('SonodigestBundle:Entrada')->findBy(array(),array('id'=>'DESC'));
        //return $this->render('SonodigestBundle:Ciruyproc:ciruyproc.html.twig');     
        //var_dump($categorias[0]->getSubcategoria()[0]->getNombre());
        //var_dump($subcategorias->getSubcategoria());
        //var_dump($categoriasBlog);
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
        $fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ;
        
        //var_dump($fecha);
        return array(
            'categoriasBlog' => $categoriasBlog,
            'entradas' => $entradas,
            'registro'=>null
        );
        
        //return $this->render('SonodigestBundle:Blog:blog.html.twig');     
    }
    
    
    /**
     * Lista entradas del blog.
     *
     * @Route("/entradas/blog/{id}", name="admin_blog_entradas")
     * @Method("GET")
     * @Template("SonodigestBundle:Blog:contenido.html.twig")
     */
    public function entradasblogAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entradas = $em->getRepository('SonodigestBundle:Entrada')->findBy(array('idcategoria'=>$id),array('id'=>'DESC'));
        //return $this->render('SonodigestBundle:Ciruyproc:ciruyproc.html.twig');     
        //var_dump($categorias[0]->getSubcategoria()[0]->getNombre());
        //var_dump($subcategorias->getSubcategoria());
        //var_dump($categoriasBlog);
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
        $fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ;
        
        //var_dump($fecha);
        return array(
            
            'entradas' => $entradas,
            
        );
        
        //return $this->render('SonodigestBundle:Blog:blog.html.twig');     
    }
}
