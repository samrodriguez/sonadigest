<?php

namespace SonodigestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SonodigestBundle\Entity\Subcategoria;
use SonodigestBundle\Form\SubcategoriaType;

/**
 * Subcategoria controller.
 *
 * @Route("/admin/subcategoria")
 */
class SubcategoriaController extends Controller
{

    /**
     * Lists all Subcategoria entities.
     *
     * @Route("/", name="admin_subcategoria")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SonodigestBundle:Subcategoria')->findBy(array(),array('id' => 'DESC'));
        
        $entity = new Subcategoria();
        $form   = $this->createCreateForm($entity);
        
        return array(
            'entities' => $entities,
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    /**
     * Creates a new Subcategoria entity.
     *
     * @Route("/", name="admin_subcategoria_create")
     * @Method("POST")
     * @Template("SonodigestBundle:Subcategoria:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Subcategoria();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

        if($entity->getFile()!=null){
                    $path = $this->container->getParameter('photo.subcategoria');

                    $fecha = date('Y-m-d His');
                    $extension = $entity->getFile()->getClientOriginalExtension();
                    $nombreArchivo = $entity->getId()."-".$fecha.".".$extension;
                    $em->persist($entity);
                    $em->flush();
                    //var_dump($path.$nombreArchivo);

                    $entity->setFoto($nombreArchivo);
                    $entity->getFile()->move($path,$nombreArchivo);
                    $em->persist($entity);
                    $em->flush();
                }

            //return $this->redirect($this->generateUrl('admin_subcategoria_show', array('id' => $entity->getId())));
            return $this->redirect($this->generateUrl('admin_subcategoria'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Subcategoria entity.
     *
     * @param Subcategoria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Subcategoria $entity)
    {
        $form = $this->createForm(new SubcategoriaType(), $entity, array(
            'action' => $this->generateUrl('admin_subcategoria_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear',
            'attr'=>array('class'=>'botonpanel'))
        );

        return $form;
    }

    /**
     * Displays a form to create a new Subcategoria entity.
     *
     * @Route("/new", name="admin_subcategoria_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Subcategoria();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Subcategoria entity.
     *
     * @Route("/{id}", name="admin_subcategoria_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:Subcategoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subcategoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Subcategoria entity.
     *
     * @Route("/{id}/edit", name="admin_subcategoria_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:Subcategoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subcategoria entity.');
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
    * Creates a form to edit a Subcategoria entity.
    *
    * @param Subcategoria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Subcategoria $entity)
    {
        $form = $this->createForm(new SubcategoriaType(), $entity, array(
            'action' => $this->generateUrl('admin_subcategoria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update',
            'attr'=>array('class'=>'botonpanel'))
                
            );

        return $form;
    }
    /**
     * Edits an existing Subcategoria entity.
     *
     * @Route("/{id}", name="admin_subcategoria_update")
     * @Method("PUT")
     * @Template("SonodigestBundle:Subcategoria:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:Subcategoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subcategoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
        
        if($entity->getFile()!=null){
            $path = $this->container->getParameter('photo.subcategoria');

            $fecha = date('Y-m-d His');
            $extension = $entity->getFile()->getClientOriginalExtension();
            $nombreArchivo = "subcategoria_".$fecha.".".$extension;

            //var_dump($path.$nombreArchivo);

            $entity->setfoto($nombreArchivo);


            $entity->getFile()->move($path,$nombreArchivo);
        }
            $em->flush();

            return $this->redirect($this->generateUrl('admin_subcategoria', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Subcategoria entity.
     *
     * @Route("/{id}", name="admin_subcategoria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SonodigestBundle:Subcategoria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Subcategoria entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_subcategoria'));
    }

    /**
     * Creates a form to delete a Subcategoria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_subcategoria_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit',  array('label' => 'Borrar',
            'attr'=>array('class'=>'botonpanel'))
            )
            ->getForm()
        ;
    }
}
