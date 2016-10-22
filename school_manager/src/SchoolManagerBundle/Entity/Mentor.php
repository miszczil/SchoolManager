<?php

namespace SchoolManagerBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Mentor
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="SchoolManagerBundle\Entity\MentorRepository")
 */
class Mentor extends BaseUser
{
    public function __construct() {

        parent:: __construct();      

        $this->courses = new ArrayCollection();
        $this->canTeach = new ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=TRUE)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=TRUE)
     */
    private $phone;

    /**
     * @ORM\ManyToMany(targetEntity="Subject", inversedBy="mentors") 
     */
    private $canTeach;

    /**
     * @ORM\ManyToMany(targetEntity="Course", inversedBy="groups") 
     */
    private $courses;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Mentor
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
     * Set email
     *
     * @param string $email
     * @return Mentor
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
     * Set phone
     *
     * @param string $phone
     * @return Mentor
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
     * Set canTeach
     *
     * @param string $canTeach
     * @return Mentor
     */
    public function setCanTeach($canTeach)
    {
        $this->canTeach = $canTeach;

        return $this;
    }

    /**
     * Get canTeach
     *
     * @return simple_array 
     */
    public function getCanTeach()
    {
        return $this->canTeach;
    }

    /**
     * Add courses
     *
     * @param \SchoolManagerBundle\Entity\Course $courses
     * @return Mentor
     */
    public function addCourse(\SchoolManagerBundle\Entity\Course $courses)
    {
        $this->courses[] = $courses;

        return $this;
    }

    /**
     * Remove courses
     *
     * @param \SchoolManagerBundle\Entity\Course $courses
     */
    public function removeCourse(\SchoolManagerBundle\Entity\Course $courses)
    {
        $this->courses->removeElement($courses);
    }

    /**
     * Get courses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCourses()
    {
        return $this->courses;
    }
}
