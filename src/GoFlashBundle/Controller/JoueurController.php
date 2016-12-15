<?php

namespace GoFlashBundle\Controller;

use GoFlashBundle\Entity\Joueur;
use Application\Sonata\UserBundle\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Joueur controller.
 *
 * @Route("joueur")
 */
class JoueurController extends Controller
{
    /**
     * Lists all joueur entities.
     *
     * @Route("/", name="joueur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user_Id = getJoueurs();

        $joueurs = $em->getRepository('GoFlashBundle:Joueur')->findBy($user_Id);

        return $this->render('@GoFlash/joueur/index.html.twig', array(
            'joueurs' => $joueurs,
        ));
    }

    /**
     * Creates a new joueur entity.
     *
     * @Route("/new", name="joueur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $joueur = new Joueur();
        $form = $this->createForm('GoFlashBundle\Form\JoueurType', $joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($joueur);
            $em->flush($joueur);

            return $this->redirectToRoute('joueur_show', array('id' => $joueur->getId()));
        }

        return $this->render('@GoFlash/joueur/new.html.twig', array(
            'joueur' => $joueur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a joueur entity.
     *
     * @Route("/{id}", name="joueur_show")
     * @Method("GET")
     */
    public function showAction(Joueur $joueur)
    {
        $deleteForm = $this->createDeleteForm($joueur);

        return $this->render('@GoFlash/joueur/show.html.twig', array(
            'joueur' => $joueur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing joueur entity.
     *
     * @Route("/{id}/edit", name="joueur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Joueur $joueur)
    {
        $deleteForm = $this->createDeleteForm($joueur);
        $editForm = $this->createForm('GoFlashBundle\Form\JoueurType', $joueur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('joueur_edit', array('id' => $joueur->getId()));
        }

        return $this->render('@GoFlash/joueur/edit.html.twig', array(
            'joueur' => $joueur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

//    /**
//     * Deletes a joueur entity.
//     *
//     * @Route("/{id}", name="joueur_delete")
//     * @Method("DELETE")
//     */
//    public function deleteAction(Request $request, Joueur $joueur)
//    {
//        $form = $this->createDeleteForm($joueur);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($joueur);
//            $em->flush($joueur);
//        }
//
//        return $this->redirectToRoute('joueur_index');
//    }
//
//    /**
//     * Creates a form to delete a joueur entity.
//     *
//     * @param Joueur $joueur The joueur entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm(Joueur $joueur)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('joueur_delete', array('id' => $joueur->getId())))
//            ->setMethod('DELETE')
//            ->getForm()
//        ;
//    }
}
