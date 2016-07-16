<?php

namespace Labs\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="Labs\BackBundle\Repository\BookingRepository")
 */
class Booking
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
     * @Assert\Email(message="Entrez un email valide")
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @var string
     * @Assert\NotBlank(message="Entrez le lieu de l'evenement avant de continuer")
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    protected $lieu;

    /**
     * @var string
     * @Assert\NotBlank(message="Entrez votre nom")
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;


    /**
     * @var Date
     * @Assert\Date(message="Entrez une date valide")
     * @Assert\NotBlank(message="Entrez une date de reservation avant de continer")
     * @ORM\Column(name="date_res", type="date")
     */
    protected $date_res;

    /**
     * @var
     * @Assert\NotBlank(message="Veuillez choisir votre package")
     * @ORM\ManyToOne(targetEntity="Labs\BackBundle\Entity\Packages", inversedBy="booking")
     */
    protected $packages;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    protected $status;


    public function __construct()
    {
        $this->status = false;
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
     * Set email
     *
     * @param string $email
     *
     * @return booking
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return booking
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return booking
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
     * Set status
     *
     * @param boolean $status
     *
     * @return booking
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return Date
     */
    public function getDateRes()
    {
        return $this->date_res;
    }

    /**
     * @param Date $date_res
     */
    public function setDateRes($date_res)
    {
        $this->date_res = $date_res;
    }


    /**
     * Set packages
     *
     * @param \Labs\BackBundle\Entity\Packages $packages
     *
     * @return Booking
     */
    public function setPackages(\Labs\BackBundle\Entity\Packages $packages = null)
    {
        $this->packages = $packages;

        return $this;
    }

    /**
     * Get packages
     *
     * @return \Labs\BackBundle\Entity\Packages
     */
    public function getPackages()
    {
        return $this->packages;
    }
}
