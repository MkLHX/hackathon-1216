<?php

namespace GoFlashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Experience
 *
 * @ORM\Table(name="experience")
 * @ORM\Entity(repositoryClass="GoFlashBundle\Repository\ExperienceRepository")
 */
class Experience
{

    /**
     * @ORM\OneToOne(targetEntity="GoFlashBundle\Entity\Joueur", mappedBy="experience")
     */
    private $joueur;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="experience", type="integer")
     */
    private $experience;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau", type="integer")
     */
    private $niveau;


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
     * Set experience
     *
     * @param integer $experience
     *
     * @return Experience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return int
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set niveau
     *
     * @param string $niveau
     *
     * @return Experience
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * @return mixed
     */
    public function getJoueur()
    {
        return $this->joueur;
    }

    /**
     * @param mixed $joueur
     */
    public function setJoueur($joueur)
    {
        $this->joueur = $joueur;
    }


}
