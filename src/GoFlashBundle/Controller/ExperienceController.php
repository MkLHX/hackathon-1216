<?php

namespace GoFlashBundle\Controller;

use Application\Sonata\UserBundle\Controller\ProfileFOSUser1Controller;
use GoFlashBundle\Entity\Experience;
use GoFlashBundle\Entity\Jeu;
use GoFlashBundle\Entity\Joueur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

/**
 * Experience controller.
 *
 * @Route("experience")
 */
class ExperienceController extends Controller
{
//    /**
//     * Creates a new experience entity.
//     *
//     * @Route("/new", name="experience_new")
//     * @Method({"GET", "POST"})
//     */
//    public function newAction(Request $request)
//    {
//        $experience = new Experience();
//        $form = $this->createForm('GoFlashBundle\Form\ExperienceType', $experience);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($experience);
//            $em->flush($experience);
//
//            return $this->redirectToRoute('experience_show', array('id' => $experience->getId()));
//        }
//
//        return $this->render('@GoFlash/experience/new.html.twig', array(
//            'experience' => $experience,
//            'form' => $form->createView(),
//        ));
//    }

    /**
     * Finds and displays a experience entity.
     *
     * @Route("/{id}", name="experience_show")
     * @Method("GET")
     */
    public function showAction(Experience $experience)
    {
        $deleteForm = $this->createDeleteForm($experience);

        return $this->render('@GoFlash/experience/show.html.twig', array(
            'experience' => $experience,
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing experience entity.
     *
     * @Route("/{id}/edit", name="experience_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Experience $experience, Profile $id, Joueur $idUser, Jeu $id)
    {
//        $deleteForm = $this->createDeleteForm($experience);
//        $editForm = $this->createForm('GoFlashBundle\Form\ExperienceType', $experience);

        $editForm->handleRequest($request);
//      ICI ON DOIT RECUPERER LES DONNEES DES CHAMPS ID.JOUEUR, USER_ID.JOUEUR, IMAGE_ESSAI.JOUEUR, USER_ID.EXPERIENCE;
//                                                   EXPERIENCE.EXPERIENCE, NIVEAU.EXPERIENCE,
//                                                   ID.PROFILEFOSUSER1

        if (){

        }

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $editForm->setProfileFOSUser1Controller($editForm->getJoueur()->getProfileFOSUser1Controller());

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('experience_edit', array('id' => $experience->getId()));
        }

        return $this->render('@GoFlash/experience/edit.html.twig', array(
            'experience' => $experience,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        ));
    }

//    /**
//     * Deletes a experience entity.
//     *
//     * @Route("/{id}", name="experience_delete")
//     * @Method("DELETE")
//     */
//    public function deleteAction(Request $request, Experience $experience)
//    {
//        $form = $this->createDeleteForm($experience);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($experience);
//            $em->flush($experience);
//        }
//
//        return $this->redirectToRoute('experience_index');
//    }
//
//    /**
//     * Creates a form to delete a experience entity.
//     *
//     * @param Experience $experience The experience entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm(Experience $experience)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('experience_delete', array('id' => $experience->getId())))
//            ->setMethod('DELETE')
//            ->getForm()
//        ;
//    }
}
