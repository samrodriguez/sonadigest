<?php

namespace SonodigestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Categoria controller.
 *
 * @Route("/admin/ciruyproc")
 */
class CiruyprocController extends Controller{
    
    /**
     * Lists all Categoria entities.
     *
     * @Route("/", name="admin_cirugia")
     * @Method("GET")
     * @Template("SonodigestBundle:Ciruyproc:ciruyproc.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $categorias = $em->getRepository('SonodigestBundle:Categoria')->findAll();
        $subcategorias = $em->getRepository('SonodigestBundle:Subcategoria')->findAll();
        //return $this->render('SonodigestBundle:Ciruyproc:ciruyproc.html.twig');     
        //var_dump($categorias[0]->getSubcategoria()[0]->getNombre());
        //var_dump($subcategorias->getSubcategoria());
        //var_dump($categorias);
        return array(
            'categorias' => $categorias,
            'subcategorias' => $subcategorias,
            'registro'=>null
        );
    }
    
    
    
    
    
    
    /**
     * Muestra la informacion de la subcategoria
     *
     * @Route("/subcategoria/get/{id}", name="get_subcategoria")
     * @Method("GET")
     * @Template()
     */
    public function contenidoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SonodigestBundle:Subcategoria')->find($id);
        //var_dump($entity->getIdProblema());
        return array(
            'registro' => $entity,
        );
    }
    
    
    
    /**
     * @Route("/subcategoriafoto/get/{id}", name="get_subcategoriaFoto", options={"expose"=true})
     * @Method("GET")
     */
    public function subcategoriaFotoAction(Request $request, $id) {
        
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('SonodigestBundle:Subcategoria')->find($id);
        
        //var_dump($entity);
        $path=$this->getParameter('photo.subcategoria').$entity->getFoto();
        
        
        
        if(count($entity)!=0){
            if($entity->getFoto()!=""){
                if (file_exists($path)) {
                    $subcategoria['regs'] = $entity->getFoto();  //Registro encontrado
                } else {
                    $subcategoria['regs'] = 0;  //No existe la imagen en el directorio
                }
            }
            else{
                $subcategoria['regs'] = 0;  //Nombre de foto vacío
            }
                
                
        }
        else{
            $subcategoria['regs'] = 1;  //Registro no encontrada
        }
        
        //var_dump($path);
        
        return new Response(json_encode($subcategoria));
    }
    
    
}
