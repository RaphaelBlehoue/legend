<?php

namespace Labs\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Best
 *
 * @ORM\Table(name="best")
 * @ORM\Entity(repositoryClass="Labs\BackBundle\Repository\BestRepository")
 */
class Best
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
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    protected $content;

    /**
     * @var string
     *
     * @ORM\Column(name="media", type="string", length=255)
     */
    protected $media;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Labs\BackBundle\Entity\Dossier", inversedBy="bests")
     * @ORM\JoinColumn(referencedColumnName="dossier_id", nullable=false)
     */
    protected $dossier;


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
     * @return Best
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
     * @return Best
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
     * Set media
     *
     * @param string $media
     *
     * @return Best
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set dossier
     *
     * @param \Labs\BackBundle\Entity\Dossier $dossier
     *
     * @return Best
     */
    public function setDossier(\Labs\BackBundle\Entity\Dossier $dossier)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return \Labs\BackBundle\Entity\Dossier
     */
    public function getDossier()
    {
        return $this->dossier;
    }
}
