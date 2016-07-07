<?php

namespace Labs\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Packages
 *
 * @ORM\Table(name="packages")
 * @ORM\Entity(repositoryClass="Labs\BackBundle\Repository\PackagesRepository")
 */
class Packages
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
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    protected $content;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     */
    protected $color;


    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Labs\BackBundle\Entity\Packs", inversedBy="packages")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     */
    protected $pack;


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
     * @return Packages
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
     * @return Packages
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
     * Set color
     *
     * @param string $color
     *
     * @return Packages
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set pack
     *
     * @param \Labs\BackBundle\Entity\Packs $pack
     *
     * @return Packages
     */
    public function setPack(\Labs\BackBundle\Entity\Packs $pack = null)
    {
        $this->pack = $pack;

        return $this;
    }

    /**
     * Get pack
     *
     * @return \Labs\BackBundle\Entity\Packs
     */
    public function getPack()
    {
        return $this->pack;
    }
}
