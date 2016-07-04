<?php

namespace Labs\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="Labs\BackBundle\Repository\MediaRepository")
 */
class Media
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
     * @ORM\Column(name="url", type="string", length=255)
     */
    protected $url;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    protected $status;

    /**
     * @var bool
     *
     * @ORM\Column(name="actived", type="boolean")
     */
    protected $actived;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Labs\BackBundle\Entity\Dossier", inversedBy="medias")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     */
    protected $dossier;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Labs\BackBundle\Entity\Type", inversedBy="medias")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     */
    protected $type;

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
     * Set url
     *
     * @param string $url
     *
     * @return Media
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Media
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
     * Set actived
     *
     * @param boolean $actived
     *
     * @return Media
     */
    public function setActived($actived)
    {
        $this->actived = $actived;

        return $this;
    }

    /**
     * Get actived
     *
     * @return bool
     */
    public function getActived()
    {
        return $this->actived;
    }

    /**
     * Set dossier
     *
     * @param \Labs\BackBundle\Entity\Dossier $dossier
     *
     * @return Media
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

    /**
     * Set type
     *
     * @param \Labs\BackBundle\Entity\Type $type
     *
     * @return Media
     */
    public function setType(\Labs\BackBundle\Entity\Type $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Labs\BackBundle\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }

    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur
        return 'uploads/gallery';
    }


    protected function getUploadRootDir()
    {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }


    /**
     * @return string
     */
    public function getAssertPath()
    {
        return $this->getUploadDir().'/'.$this->url;
    }
}
