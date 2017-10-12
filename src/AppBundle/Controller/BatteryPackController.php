<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BatteryPack;
use AppBundle\Form\BatteryPackType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

/**
 * Batterypack controller.
 *
 * @Route("batterypack")
 */
class BatteryPackController extends BaseController
{
    /**
     * Lists all batteryPack entities.
     *
     * @Route("/", name="batterypack_index")
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction()
    {
        /** @var BatteryPack $batteryPacks */
        $batteryPacks = $this->getEntityManager()->getRepository(BatteryPack::class)->findAll();

        return $this->render('batterypack/index.html.twig', array(
            'batteryPacks' => $batteryPacks,
        ));
    }

    /**
     * Creates a new batteryPack entity.
     *
     * @Route("/new", name="batterypack_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(BatteryPackType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $batteryPack = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($batteryPack);
            $em->flush();

            return $this->redirectToRoute('batterypack_show', array('id' => $batteryPack->getId()));
        }

        return $this->render('batterypack/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a batteryPack entity.
     *
     * @Route("/{id}", name="batterypack_show")
     * @Method("GET")
     *
     * @param BatteryPack $batteryPack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(BatteryPack $batteryPack)
    {
        $deleteForm = $this->createDeleteForm($batteryPack);

        return $this->render('batterypack/show.html.twig', array(
            'batteryPack' => $batteryPack,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing batteryPack entity.
     *
     * @Route("/{id}/edit", name="batterypack_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param BatteryPack $batteryPack
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function editAction(Request $request, BatteryPack $batteryPack)
    {
        $deleteForm = $this->createDeleteForm($batteryPack);
        $editForm = $this->createForm(BatteryPackType::class, $batteryPack);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('batterypack_edit', array('id' => $batteryPack->getId()));
        }

        return $this->render('batterypack/edit.html.twig', array(
            'batteryPack' => $batteryPack,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     *
     * Deletes a batteryPack entity.
     *
     * @Route("/{id}", name="batterypack_delete")
     * @Method("DELETE")
     *
     * @param Request $request
     * @param BatteryPack $batteryPack
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, BatteryPack $batteryPack)
    {
        $form = $this->createDeleteForm($batteryPack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($batteryPack);
            $em->flush();
        }

        return $this->redirectToRoute('batterypack_index');
    }

    /**
     *  Creates a form to delete a batteryPack entity.
     * @param BatteryPack $batteryPack
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(BatteryPack $batteryPack)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('batterypack_delete', array('id' => $batteryPack->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
