<?php

namespace GoFlashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Joueur
 *
 * @ORM\Table(name="joueur")
 * @ORM\Entity(repositoryClass="GoFlashBundle\Repository\JoueurRepository")
 */
class Joueur
{

    /**
     * @var string
     *
     * @ORM\Column(name="todo", type="boolean")
     */
    private $toDo;
    /**
     * @var string
     *
     * @ORM\Column(name="evaluate", type="boolean")
     */
    private $evaluate;

    /**
     * @return string
     */
    public function getEvaluate ()
    {
        return $this->evaluate;
    }

    /**
     * @param string $evaluate
     */
    public function setEvaluate ($evaluate)
    {
        $this->evaluate = $evaluate;
    }

    /**
     * @return string
     */
    public function getToDo ()
    {
        return $this->toDo;
    }

    /**
     * @param string $toDo
     */
    public function setToDo ($toDo)
    {
        $this->toDo = $toDo;
    }


/* --------------------------------------- CODE GENERE SYMFONY ---------------------------------------------*/
    /**
     * @ORM\OneToOne(targetEntity="GoFlashBundle\Entity\Experience", inversedBy="joueur")
     *
     */
    private $experience;



    /**
     * @ORM\ManyToMany(targetEntity="GoFlashBundle\Entity\Jeu", inversedBy="joueurs")
     */
    private $jeux;


    /**
     * @ORM\ManyToMany(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="joueurs")
     */
    private $users;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="image_essai", type="string", length=255)
     */
    private $imageEssai;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set imageEssai
     *
     * @param string $imageEssai
     *
     * @return Joueur
     */
    public function setImageEssai($imageEssai)
    {
        $this->imageEssai = $imageEssai;

        return $this;
    }

    /**
     * Get imageEssai
     *
     * @return string
     */
    public function getImageEssai()
    {
        return $this->imageEssai;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @return mixed
     */
    public function getJeux()
    {
        return $this->jeux;
    }

    /**
     * @param mixed $jeux
     */
    public function setJeux($jeux)
    {
        $this->jeux = $jeux;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param mixed $experience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;
    }




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jeux = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add jeux
     *
     * @param \GoFlashBundle\Entity\Jeu $jeux
     *
     * @return Joueur
     */
    public function addJeux(\GoFlashBundle\Entity\Jeu $jeux)
    {
        $this->jeux[] = $jeux;

        return $this;
    }

    /**
     * Remove jeux
     *
     * @param \GoFlashBundle\Entity\Jeu $jeux
     */
    public function removeJeux(\GoFlashBundle\Entity\Jeu $jeux)
    {
        $this->jeux->removeElement($jeux);
    }

    /**
     * Add user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     *
     * @return Joueur
     */
    public function addUser(\Application\Sonata\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     */
    public function removeUser(\Application\Sonata\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }
}
