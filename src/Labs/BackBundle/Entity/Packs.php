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
     *
     * @ORM\Column(name="color", type="string", length=225, nullable=true)
     */
    protected $color;

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
     * @ORM\OneToMany(targetEntity="Labs\BackBundle\Entity\Packages", mappedBy="pack", cascade={"remove"})
     */
    protected $packages;


    public function __construct()
    {
        $this->online = true;
        $this->colors = '#fff';
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
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }


    /**
     * Add package
     *
     * @param \Labs\BackBundle\Entity\Packages $package
     *
     * @return Packs
     */
    public function addPackage(\Labs\BackBundle\Entity\Packages $package)
    {
        $this->packages[] = $package;

        return $this;
    }

    /**
     * Remove package
     *
     * @param \Labs\BackBundle\Entity\Packages $package
     */
    public function removePackage(\Labs\BackBundle\Entity\Packages $package)
    {
        $this->packages->removeElement($package);
    }

    /**
     * Get packages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPackages()
    {
        return $this->packages;
    }
}
