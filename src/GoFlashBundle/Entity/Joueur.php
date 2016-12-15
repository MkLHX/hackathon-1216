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




}
