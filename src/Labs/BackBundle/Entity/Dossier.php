<?php

namespace Labs\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Dossier
 *
 * @ORM\Table(name="dossier")
 * @ORM\Entity(repositoryClass="Labs\BackBundle\Repository\DossierRepository")
 */
class Dossier
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
     * @Assert\NotNull(message="Entrez le nom du dossier")
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     * @Assert\NotNull(message="Entrez le nom du marié avant de continuer")
     * @ORM\Column(name="wedding_men", type="string", length=255)
     */
    protected $weddingMen;

    /**
     * @var string
     * @Assert\NotNull(message="Entrez le nom de la marié avant de continuer")
     * @ORM\Column(name="wedding_women", type="string", length=255)
     */
    protected $weddingWomen;

    /**
     * @var string
     * @Assert\NotNull(message="Entrez la description de la rencontre")
     * @ORM\Column(name="content", type="text")
     */
    protected $content;

    /**
     * @var \DateTime
     * @Assert\NotNull(message="Rentrez la date de céremonie")
     * @Assert\Date(message="Entrez une date valide")
     * @ORM\Column(name="ceremony_date", type="date")
     */
    protected $ceremonyDate;

    /**
     * @var string
     *
     * @ORM\Column(name="colors", type="string", length=255)
     */
    protected $colors;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     */
    protected $video;

    /**
     * @var string
     *
     * @ORM\Column(name="video_prewedding", type="string", length=255, nullable=true)
     */
    protected $video_prewedding;

    /**
     * @var
     *
     * @ORM\Column(name="online", type="boolean")
     */
    protected $online;

    /**
     * @var
     *
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Labs\BackBundle\Entity\Media", mappedBy="dossier", cascade={"remove"})
     */
    protected $medias;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Labs\BackBundle\Entity\Best", mappedBy="dossier", cascade={"remove"})
     */
    protected $bests;

    /**
     * @var
     * @Assert\NotBlank(message="Faite le choix d'un pack avant de continuer")
     * @ORM\ManyToOne(targetEntity="Labs\BackBundle\Entity\Packages", inversedBy="dossier")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     */
    protected $package;
    

    public function __construct()
    {
        $this->colors = '#fff';
        $this->created = new \DateTime('now');
        $this->online = false;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Set weddingMen
     *
     * @param string $weddingMen
     *
     * @return Dossier
     */
    public function setWeddingMen($weddingMen)
    {
        $this->weddingMen = $weddingMen;

        return $this;
    }

    /**
     * Get weddingMen
     *
     * @return string
     */
    public function getWeddingMen()
    {
        return $this->weddingMen;
    }

    /**
     * Set weddingWomen
     *
     * @param string $weddingWomen
     *
     * @return Dossier
     */
    public function setWeddingWomen($weddingWomen)
    {
        $this->weddingWomen = $weddingWomen;

        return $this;
    }

    /**
     * Get weddingWomen
     *
     * @return string
     */
    public function getWeddingWomen()
    {
        return $this->weddingWomen;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Dossier
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
     * Set ceremonyDate
     *
     * @param \DateTime $ceremonyDate
     *
     * @return Dossier
     */
    public function setCeremonyDate($ceremonyDate)
    {
        $this->ceremonyDate = $ceremonyDate;

        return $this;
    }

    /**
     * Get ceremonyDate
     *
     * @return \DateTime
     */
    public function getCeremonyDate()
    {
        return $this->ceremonyDate;
    }

    /**
     * Set colors
     *
     * @param string $colors
     *
     * @return Dossier
     */
    public function setColors($colors)
    {
        $this->colors = $colors;

        return $this;
    }

    /**
     * Get colors
     *
     * @return string
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * Get video
     * 
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set video
     * 
     * @param string $video
     * 
     * @return Dossier
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * @return string
     */
    public function getVideoPrewedding()
    {
        return $this->video_prewedding;
    }

    /**
     * @param string $video_prewedding
     */
    public function setVideoPrewedding($video_prewedding)
    {
        $this->video_prewedding = $video_prewedding;
    }


    /**
     * Add media
     *
     * @param \Labs\BackBundle\Entity\Media $media
     *
     * @return Dossier
     */
    public function addMedia(\Labs\BackBundle\Entity\Media $media)
    {
        $this->medias[] = $media;

        return $this;
    }

    /**
     * Remove media
     *
     * @param \Labs\BackBundle\Entity\Media $media
     */
    public function removeMedia(\Labs\BackBundle\Entity\Media $media)
    {
        $this->medias->removeElement($media);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Add best
     *
     * @param \Labs\BackBundle\Entity\Best $best
     *
     * @return Dossier
     */
    public function addBest(\Labs\BackBundle\Entity\Best $best)
    {
        $this->bests[] = $best;

        return $this;
    }

    /**
     * Remove best
     *
     * @param \Labs\BackBundle\Entity\Best $best
     */
    public function removeBest(\Labs\BackBundle\Entity\Best $best)
    {
        $this->bests->removeElement($best);
    }

    /**
     * Get bests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBests()
    {
        return $this->bests;
    }

    /**
     * @return mixed
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * @param mixed $online
     */
    public function setOnline($online)
    {
        $this->online = $online;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }
    

    /**
     * Set package
     *
     * @param \Labs\BackBundle\Entity\Packages $package
     *
     * @return Dossier
     */
    public function setPackage(\Labs\BackBundle\Entity\Packages $package)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \Labs\BackBundle\Entity\Packages
     */
    public function getPackage()
    {
        return $this->package;
    }
}
