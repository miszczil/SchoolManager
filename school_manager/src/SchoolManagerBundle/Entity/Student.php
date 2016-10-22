<?php

namespace SchoolManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SchoolManagerBundle\Entity\StudentRepository")
 */
class Student
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="parentsName", type="string", length=255)
     */
    private $parentsName;

    /**
     * @var string
     *
     * @ORM\Column(name="parentsEmail", type="string", length=255)
     */
    private $parentsEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="parentsPhone", type="string", length=20)
     */
    private $parentsPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=255, nullable=TRUE)
     */
    private $info;
    
    /**
    * @ORM\ManyToOne(targetEntity="Course", inversedBy="students")
    * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
    */
    private $course;


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
     * @return Student
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
     * Set age
     *
     * @param integer $age
     * @return Student
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set parentsName
     *
     * @param string $parentsName
     * @return Student
     */
    public function setParentsName($parentsName)
    {
        $this->parentsName = $parentsName;

        return $this;
    }

    /**
     * Get parentsName
     *
     * @return string 
     */
    public function getParentsName()
    {
        return $this->parentsName;
    }

    /**
     * Set parentsEmail
     *
     * @param string $parentsEmail
     * @return Student
     */
    public function setParentsEmail($parentsEmail)
    {
        $this->parentsEmail = $parentsEmail;

        return $this;
    }

    /**
     * Get parentsEmail
     *
     * @return string 
     */
    public function getParentsEmail()
    {
        return $this->parentsEmail;
    }

    /**
     * Set parentsPhone
     *
     * @param string $parentsPhone
     * @return Student
     */
    public function setParentsPhone($parentsPhone)
    {
        $this->parentsPhone = $parentsPhone;

        return $this;
    }

    /**
     * Get parentsPhone
     *
     * @return string 
     */
    public function getParentsPhone()
    {
        return $this->parentsPhone;
    }

    /**
     * Set info
     *
     * @param string $info
     * @return Student
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set course
     *
     * @param \SchoolManagerBundle\Entity\Course $course
     * @return Student
     */
    public function setCourse(\SchoolManagerBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \SchoolManagerBundle\Entity\Course 
     */
    public function getCourse()
    {
        return $this->course;
    }
}
