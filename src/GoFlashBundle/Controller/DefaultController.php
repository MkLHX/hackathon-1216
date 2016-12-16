<?php

namespace GoFlashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\BrowserKit\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueilAction()
    {
        return $this->render('GoFlashBundle::accueil.html.twig');
    }
    /**
     * @Route("/profile/", name="myprofileroute")
     */
    public function marouteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT jo.id, jo.todo, j.id, fos.id 
             FROM joueur as jo, jeu as j, fos_user_user as fos 
             WHERE todo = :todo AND fos.id = :idUser')
            ->setParameter('todo', true)
            ->setParameter('idUser', $this->getUser());

        $listToEval = $query->getResult();
        return new Response($listToEval);
        //var_dump($listToEval);die;
        //return new Response("T'es sur ma route!");
        //return $this->render('GoFlashBundle::accueil.html.twig');
    }

//    public function findByAgeRange($min, $max)
//    {
//
//        return $this->createQueryBuilder('e')
//            ->where('e.age BETWEEN :min AND :max')
//            ->setParameter('min', $min)
//            ->setParameter('max', $max)
//
//            ->orderBy('e.age', 'DESC')
//            ->getQuery()
//            ->getResult();
//    }
//
//    public function findByLike($input){
//
//        return $this->createQueryBuilder('e')
//            ->where('e.nom LIKE :input ')
//            ->setParameter('input', "%$input%")
//
//            ->orWhere("e.prenom LIKE :input ")
//            ->setParameter('input', "%$input%")
//
//            ->getQuery()
//            ->getResult();
//    }
// Syntaxe DQL : on veut récupérer des objets et non des colonnes d'une table
//        $query = $em->createQuery(
//            'SELECT e
//            FROM RechercheBundle:Eleve e
//            WHERE e.age BETWEEN :min AND :max
//            ORDER BY e.age ASC'
//        )   ->setParameter('min', $min)
//            ->setParameter('max', $max)
//        ;
//        $eleves = $query->getResult();

}
