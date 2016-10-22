<?php

namespace SchoolManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subject
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SchoolManagerBundle\Entity\SubjectRepository")
 */
class Subject
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2000)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="suggestedStudentAge", type="string", length=255)
     */
    private $suggestedStudentAge;

    /**
     * @var integer
     *
     * @ORM\Column(name="hourlyRateForMentor", type="integer")
     */
    private $hourlyRateForMentor;
    
    //mentors that can teach this subject
    /**
     * @ORM\ManyToMany(targetEntity="Mentor", inversedBy="canTeach") 
     */
    private $mentors;


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
     * @return Subject
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
     * Set description
     *
     * @param string $description
     * @return Subject
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set suggestedStudentAge
     *
     * @param string $suggestedStudentAge
     * @return Subject
     */
    public function setSuggestedStudentAge($suggestedStudentAge)
    {
        $this->suggestedStudentAge = $suggestedStudentAge;

        return $this;
    }

    /**
     * Get suggestedStudentAge
     *
     * @return string 
     */
    public function getSuggestedStudentAge()
    {
        return $this->suggestedStudentAge;
    }

    /**
     * Set hourlyRateForMentor
     *
     * @param integer $hourlyRateForMentor
     * @return Subject
     */
    public function setHourlyRateForMentor($hourlyRateForMentor)
    {
        $this->hourlyRateForMentor = $hourlyRateForMentor;

        return $this;
    }

    /**
     * Get hourlyRateForMentor
     *
     * @return integer 
     */
    public function getHourlyRateForMentor()
    {
        return $this->hourlyRateForMentor;
    }
}
