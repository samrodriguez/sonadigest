<?php

namespace SonodigestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SonodigestBundle\Entity\Imagenindex;
use SonodigestBundle\Form\ImagenindexType;

/**
 * Imagenindex controller.
 *
 * @Route("/admin/imagenindex")
 */
class ImagenindexController extends Controller
{

    /**
     * Lists all Imagenindex entities.
     *
     * @Route("/", name="admin_imagenindex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SonodigestBundle:Imagenindex')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Imagenindex entity.
     *
     * @Route("/", name="admin_imagenindex_create")
     * @Method("POST")
     * @Template("SonodigestBundle:Imagenindex:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Imagenindex();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
        if($entity->getFile()!=null){
                    $path = $this->container->getParameter('photo.imagenindex');

                    $fecha = date('Y-m-d His');
                    $extension = $entity->getFile()->getClientOriginalExtension();
                    $nombreArchivo = "imagenindex_".$fecha.".".$extension;
                    $em->persist($entity);
                    $em->flush();
                    //var_dump($path.$nombreArchivo);

                    $entity->setImagen($nombreArchivo);
                    $entity->getFile()->move($path,$nombreArchivo);
                    $em->persist($entity);
                    $em->flush();
                }    
        

            return $this->redirect($this->generateUrl('admin_imagenindex_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Imagenindex entity.
     *
     * @param Imagenindex $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Imagenindex $entity)
    {
        $form = $this->createForm(new ImagenindexType(), $entity, array(
            'action' => $this->generateUrl('admin_imagenindex_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Imagenindex entity.
     *
     * @Route("/new", name="admin_imagenindex_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Imagenindex();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Imagenindex entity.
     *
     * @Route("/{id}", name="admin_imagenindex_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:Imagenindex')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Imagenindex entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Imagenindex entity.
     *
     * @Route("/{id}/edit", name="admin_imagenindex_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:Imagenindex')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Imagenindex entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Imagenindex entity.
    *
    * @param Imagenindex $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Imagenindex $entity)
    {
        $form = $this->createForm(new ImagenindexType(), $entity, array(
            'action' => $this->generateUrl('admin_imagenindex_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Imagenindex entity.
     *
     * @Route("/{id}", name="admin_imagenindex_update")
     * @Method("PUT")
     * @Template("SonodigestBundle:Imagenindex:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:Imagenindex')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Imagenindex entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
   
        if($entity->getFile()!=null){
            $path = $this->container->getParameter('photo.imagenindex');

            $fecha = date('Y-m-d His');
            $extension = $entity->getFile()->getClientOriginalExtension();
            $nombreArchivo = "imagenindex_".$fecha.".".$extension;

            //var_dump($path.$nombreArchivo);

            $entity->setimagen($nombreArchivo);


            $entity->getFile()->move($path,$nombreArchivo);
        }
            $em->flush();
            return $this->redirect($this->generateUrl('admin_imagenindex_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Imagenindex entity.
     *
     * @Route("/{id}", name="admin_imagenindex_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SonodigestBundle:Imagenindex')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Imagenindex entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_imagenindex'));
    }

    /**
     * Creates a form to delete a Imagenindex entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_imagenindex_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
