<?php

namespace Labs\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Packs
 *
 * @ORM\Table(name="packs")
 * @ORM\Entity(repositoryClass="Labs\BackBundle\Repository\PacksRepository")
 */
class Packs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Entrez le nom d'un pack pour la prestation avant de continuer")
     * @ORM\Column(name="name", type="string", length=225)
     */
    protected $name;

    /**
     * @var string
     * @Assert\NotNull(message="Entrez un contenu avant de continuer")
     * @ORM\Column(name="content", type="text")
     */
    protected $content;

    /**
     * @var bool
     *
     * @ORM\Column(name="online", type="boolean")
     */
    protected $online;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Labs\BackBundle\Entity\Booking", mappedBy="pack", cascade={"remove"})
     */
    protected $booking;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Labs\BackBundle\Entity\Dossier", mappedBy="pack")
     */
    protected $dossier;


    public function __construct()
    {
        $this->online = true;
    }


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
     * Set name
     *
     * @param string $name
     *
     * @return Packs
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Packs
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set online
     *
     * @param boolean $online
     *
     * @return Packs
     */
    public function setOnline($online)
    {
        $this->online = $online;

        return $this;
    }

    /**
     * Get online
     *
     * @return bool
     */
    public function getOnline()
    {
        return $this->online;
    }


    /**
     * Add Booking
     *
     * @param \Labs\BackBundle\Entity\Booking $booking
     *
     * @return Packs
     */
    public function addBooking(\Labs\BackBundle\Entity\Booking $booking)
    {
        $this->booking[] = $booking;

        return $this;
    }

    /**
     * Remove Booking
     *
     * @param \Labs\BackBundle\Entity\Booking $booking
     */
    public function removeBooking(\Labs\BackBundle\Entity\Booking $booking)
    {
        $this->booking->removeElement($booking);
    }

    /**
     * Get Booking
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * Add dossier
     *
     * @param \Labs\BackBundle\Entity\Dossier $dossier
     *
     * @return Packs
     */
    public function addDossier(\Labs\BackBundle\Entity\Dossier $dossier)
    {
        $this->dossier[] = $dossier;

        return $this;
    }

    /**
     * Remove dossier
     *
     * @param \Labs\BackBundle\Entity\Dossier $dossier
     */
    public function removeDossier(\Labs\BackBundle\Entity\Dossier $dossier)
    {
        $this->dossier->removeElement($dossier);
    }

    /**
     * Get dossier
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDossier()
    {
        return $this->dossier;
    }
}
