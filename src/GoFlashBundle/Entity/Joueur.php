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
}
