<?php

namespace GoFlashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Jeu
 *
 * @ORM\Table(name="jeu")
 * @ORM\Entity(repositoryClass="GoFlashBundle\Repository\JeuRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Jeu
{
    public $file;

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // do whatever you want to generate a unique name
            $this->imageObjectif = uniqid().'.'.$this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->file->move($this->getUploadRootDir(), $this->imageObjectif);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    //  FONCTION DE TEST DU DOSSIER UPLOAD
    protected function getUploadDir()
    {
        return 'uploads/objectif';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    public function getWebPath()
    {
        return null === $this->imageObjectif ? null : $this->getUploadDir().'/'.$this->imageObjectif;
    }

    public function getAbsolutePath()
    {
        return null === $this->imageObjectif ? null : $this->getUploadRootDir().'/'.$this->imageObjectif;
    }

    /* ---------------------------------- CODE GENERER --------------------------------------- */


    /**
     * @ORM\ManyToMany(targetEntity="GoFlashBundle\Entity\Joueur", mappedBy="jeux")
     */
    private $joueurs;


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
     * @ORM\Column(name="Titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Image_Objectif", type="string", length=255)
     */
    private $imageObjectif;


    /**
     * @ORM\ManyToMany(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="jeux")
     */
    private $users;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Jeu
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Jeu
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imageObjectif
     *
     * @param string $imageObjectif
     *
     * @return Jeu
     */
    public function setImageObjectif($imageObjectif)
    {
        $this->imageObjectif = $imageObjectif;

        return $this;
    }

    /**
     * Get imageObjectif
     *
     * @return string
     */
    public function getImageObjectif()
    {
        return $this->imageObjectif;
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
    public function getJoueurs()
    {
        return $this->joueurs;
    }

    /**
     * @param mixed $joueurs
     */
    public function setJoueurs($joueurs)
    {
        $this->joueurs = $joueurs;
    }




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->joueurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add joueur
     *
     * @param \GoFlashBundle\Entity\Joueur $joueur
     *
     * @return Jeu
     */
    public function addJoueur(\GoFlashBundle\Entity\Joueur $joueur)
    {
        $this->joueurs[] = $joueur;

        return $this;
    }

    /**
     * Remove joueur
     *
     * @param \GoFlashBundle\Entity\Joueur $joueur
     */
    public function removeJoueur(\GoFlashBundle\Entity\Joueur $joueur)
    {
        $this->joueurs->removeElement($joueur);
    }

    /**
     * Add user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     *
     * @return Jeu
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
