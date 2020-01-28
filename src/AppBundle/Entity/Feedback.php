<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="feedback")
 */
class Feedback
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $ip;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank(message = "Būtinas laukelis")
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank(message = "Būtinas laukelis")
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank(message = "Būtinas laukelis")
     * @Assert\Email( message = "'{{ value }}' - netaisyklingas el. pašto adresas.",)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=1000)
     * @Assert\NotBlank(message = "Būtinas laukelis")
     */
    protected $message;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}