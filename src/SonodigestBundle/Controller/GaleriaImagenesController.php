<?php

namespace SonodigestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SonodigestBundle\Entity\GaleriaImagenes;
use SonodigestBundle\Form\GaleriaImagenesType;

/**
 * GaleriaImagenes controller.
 *
 * @Route("/admin/galeriaimagenes")
 */
class GaleriaImagenesController extends Controller
{

    /**
     * Lists all GaleriaImagenes entities.
     *
     * @Route("/", name="admin_galeriaimagenes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SonodigestBundle:GaleriaImagenes')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new GaleriaImagenes entity.
     *
     * @Route("/", name="admin_galeriaimagenes_create")
     * @Method("POST")
     * @Template("SonodigestBundle:GaleriaImagenes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new GaleriaImagenes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_galeriaimagenes_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a GaleriaImagenes entity.
     *
     * @param GaleriaImagenes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(GaleriaImagenes $entity)
    {
        $form = $this->createForm(new GaleriaImagenesType(), $entity, array(
            'action' => $this->generateUrl('admin_galeriaimagenes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new GaleriaImagenes entity.
     *
     * @Route("/new", name="admin_galeriaimagenes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new GaleriaImagenes();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a GaleriaImagenes entity.
     *
     * @Route("/{id}", name="admin_galeriaimagenes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:GaleriaImagenes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GaleriaImagenes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing GaleriaImagenes entity.
     *
     * @Route("/{id}/edit", name="admin_galeriaimagenes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:GaleriaImagenes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GaleriaImagenes entity.');
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
    * Creates a form to edit a GaleriaImagenes entity.
    *
    * @param GaleriaImagenes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(GaleriaImagenes $entity)
    {
        $form = $this->createForm(new GaleriaImagenesType(), $entity, array(
            'action' => $this->generateUrl('admin_galeriaimagenes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing GaleriaImagenes entity.
     *
     * @Route("/{id}", name="admin_galeriaimagenes_update")
     * @Method("PUT")
     * @Template("SonodigestBundle:GaleriaImagenes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:GaleriaImagenes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GaleriaImagenes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_galeriaimagenes_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a GaleriaImagenes entity.
     *
     * @Route("/{id}", name="admin_galeriaimagenes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SonodigestBundle:GaleriaImagenes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GaleriaImagenes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_galeriaimagenes'));
    }

    /**
     * Creates a form to delete a GaleriaImagenes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_galeriaimagenes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
