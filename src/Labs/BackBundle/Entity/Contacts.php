<?php

namespace Labs\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Contacts
 *
 * @ORM\Table(name="contacts")
 * @ORM\Entity(repositoryClass="Labs\BackBundle\Repository\ContactsRepository")
 */
class Contacts
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
     * @ORM\Column(name="adresse", type="text", nullable=true)
     */
    protected $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="faxe", type="string", length=255, nullable=true)
     */
    protected $faxe;

    /**
     * @var string
     *
     * @ORM\Column(name="skype", type="string", length=255, nullable=true)
     */
    protected $skype;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    protected $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    protected $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube", type="string", length=255, nullable=true)
     */
    protected $youtube;

    /**
     * @var string
     *
     * @ORM\Column(name="vimeo", type="string", length=255, nullable=true)
     */
    protected $vimeo;

    /**
     * @var string
     *
     * @ORM\Column(name="pinterest", type="string", length=255, nullable=true)
     */
    protected $pinterest;

    /**
     * @var string
     *
     * @ORM\Column(name="instagram", type="string", length=255, nullable=true)
     */
    protected $instagram;

    /**
     * @var string
     *
     * @ORM\Column(name="google", type="string", length=255, nullable=true)
     */
    protected $google;

    /**
     * @var string
     * @Assert\Email(message="Entrez une adresse email valide")
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected $email;



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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Contacts
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Contacts
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set faxe
     *
     * @param string $faxe
     *
     * @return Contacts
     */
    public function setFaxe($faxe)
    {
        $this->faxe = $faxe;

        return $this;
    }

    /**
     * Get faxe
     *
     * @return string
     */
    public function getFaxe()
    {
        return $this->faxe;
    }

    /**
     * Set skype
     *
     * @param string $skype
     *
     * @return Contacts
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;

        return $this;
    }

    /**
     * Get skype
     *
     * @return string
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return Contacts
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return Contacts
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set youtube
     *
     * @param string $youtube
     *
     * @return Contacts
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;

        return $this;
    }

    /**
     * Get youtube
     *
     * @return string
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * Set vimeo
     *
     * @param string $vimeo
     *
     * @return Contacts
     */
    public function setVimeo($vimeo)
    {
        $this->vimeo = $vimeo;

        return $this;
    }

    /**
     * Get vimeo
     *
     * @return string
     */
    public function getVimeo()
    {
        return $this->vimeo;
    }

    /**
     * Set pinterest
     *
     * @param string $pinterest
     *
     * @return Contacts
     */
    public function setPinterest($pinterest)
    {
        $this->pinterest = $pinterest;

        return $this;
    }

    /**
     * Get pinterest
     *
     * @return string
     */
    public function getPinterest()
    {
        return $this->pinterest;
    }

    /**
     * Set instagram
     *
     * @param string $instagram
     *
     * @return Contacts
     */
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;

        return $this;
    }

    /**
     * Get instagram
     *
     * @return string
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * Set google
     *
     * @param string $google
     *
     * @return Contacts
     */
    public function setGoogle($google)
    {
        $this->google = $google;

        return $this;
    }

    /**
     * Get google
     *
     * @return string
     */
    public function getGoogle()
    {
        return $this->google;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


}

