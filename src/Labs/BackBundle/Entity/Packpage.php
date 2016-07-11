<?php

namespace Labs\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Packpage
 *
 * @ORM\Table(name="packpage")
 * @ORM\Entity(repositoryClass="Labs\BackBundle\Repository\PackpageRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Packpage
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
     * @Assert\NotBlank(message="entrez un l'information")
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @Assert\File(
     *     maxSize="3M",
     *     mimeTypes={"image/png", "image/jpeg", "image/jpg"}
     * )
     *
     * @Vich\UploadableField(mapping="partner_image", fileNameProperty="path")
     *
     * @var File $imageFile
     */
    protected $imageFile;

    /**
     * @var string
     * @Assert\NotBlank(message="entrez un l'information")
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string
     * @Assert\NotBlank(message="entrez un l'information")
     * @ORM\Column(name="sub_title", type="string", length=255)
     */
    protected $subTitle;

    /**
     * @var string
     * @Assert\NotBlank(message="entrez un l'information")
     * @ORM\Column(name="content", type="string", length=255)
     */
    protected $content;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    protected $path;

    /**
     * @var string
     * @Assert\NotBlank(message="entrez un l'information")
     * @ORM\Column(name="allpack_title", type="string", length=255)
     */
    protected $allpackTitle;

    /**
     * @var string
     * @Assert\NotBlank(message="entrez un l'information")
     * @ORM\Column(name="allpack_subtitle", type="string", length=255)
     */
    protected $allpackSubtitle;

    /**
     * @var dateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;


    public function __construct()
    {
        $this->created = new \DateTime('now');
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
     * @return Packpage
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
     * Set title
     *
     * @param string $title
     *
     * @return Packpage
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subTitle
     *
     * @param string $subTitle
     *
     * @return Packpage
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    /**
     * Get subTitle
     *
     * @return string
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Packpage
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
     * Set path
     *
     * @param string $path
     *
     * @return Packpage
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set allpackTitle
     *
     * @param string $allpackTitle
     *
     * @return Packpage
     */
    public function setAllpackTitle($allpackTitle)
    {
        $this->allpackTitle = $allpackTitle;

        return $this;
    }

    /**
     * Get allpackTitle
     *
     * @return string
     */
    public function getAllpackTitle()
    {
        return $this->allpackTitle;
    }

    /**
     * Set allpackSubtitle
     *
     * @param string $allpackSubtitle
     *
     * @return Packpage
     */
    public function setAllpackSubtitle($allpackSubtitle)
    {
        $this->allpackSubtitle = $allpackSubtitle;

        return $this;
    }

    /**
     * Get allpackSubtitle
     *
     * @return string
     */
    public function getAllpackSubtitle()
    {
        return $this->allpackSubtitle;
    }

    /**
     * @param File|null $image
     * @return $this
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->created = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }


    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Partner
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur
        return 'uploads/partner';
    }

    /**
     * @return string
     */
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
        return $this->getUploadDir().'/'.$this->path;
    }
}

