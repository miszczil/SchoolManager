<?php

namespace SchoolManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Course
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SchoolManagerBundle\Entity\CourseRepository")
 */
class Course
{
    
    public function __construct() {
        $this->students = new ArrayCollection();
        $this->mentors = new ArrayCollection();
    }
    
    public function __toString() {
        $subject = $this->getSubject()->getName();
        
        return "$subject | $this->location, $this->weekday $this->starttime $this->endtime";
    }
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Subject")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     */
    private $subject;
    
    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=100)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="weekday", type="string", length=30)
     */
    private $weekday;

    /**
     * @var string
     *
     * @ORM\Column(name="starttime", type="string", length=5)
     */
    private $starttime;

    /**
     * @var string
     *
     * @ORM\Column(name="endtime", type="string", length=5)
     */
    private $endtime;

    /**
     * @var integer
     *
     * @ORM\Column(name="numOfMeetings", type="integer")
     */
    private $numOfMeetings;

    /**
     * @var simple_array
     *
     * @ORM\Column(name="meetings", type="simple_array", length=255, nullable=TRUE)
     */
    private $meetings;

    /**
     * @ORM\ManyToMany(targetEntity="Mentor", inversedBy="courses")
     * @ORM\JoinTable(name="course_mentors")
     */
    private $mentors;

    /**
     * @ORM\OneToMany(targetEntity="Student", mappedBy="course")
     */    
    private $students;

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
     * Set location
     *
     * @param string $location
     * @return Course
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set weekday
     *
     * @param string $weekday
     * @return Course
     */
    public function setWeekday($weekday)
    {
        $this->weekday = $weekday;

        return $this;
    }

    /**
     * Get weekday
     *
     * @return string 
     */
    public function getWeekday()
    {
        return $this->weekday;
    }

    /**
     * Set starttime
     *
     * @param string $starttime
     * @return Course
     */
    public function setStarttime($starttime)
    {
        $this->starttime = $starttime;

        return $this;
    }

    /**
     * Get starttime
     *
     * @return string 
     */
    public function getStarttime()
    {
        return $this->starttime;
    }

    /**
     * Set endtime
     *
     * @param string $endtime
     * @return Course
     */
    public function setEndtime($endtime)
    {
        $this->endtime = $endtime;

        return $this;
    }

    /**
     * Get endtime
     *
     * @return string 
     */
    public function getEndtime()
    {
        return $this->endtime;
    }

    /**
     * Set numOfMeetings
     *
     * @param integer $numOfMeetings
     * @return Course
     */
    public function setNumOfMeetings($numOfMeetings)
    {
        $this->numOfMeetings = $numOfMeetings;

        return $this;
    }

    /**
     * Get numOfMeetings
     *
     * @return integer 
     */
    public function getNumOfMeetings()
    {
        return $this->numOfMeetings;
    }

    /**
     * Set meetings
     *
     * @param string $meetings
     * @return Course
     */
    public function setMeetings($meetings)
    {
        $this->meetings = $meetings;

        return $this;
    }

    /**
     * Get meetings
     *
     * @return string 
     */
    public function getMeetings()
    {
        return $this->meetings;
    }

    /**
     * Set subject
     *
     * @param \SchoolManagerBundle\Entity\Subject $subject
     * @return Course
     */
    public function setSubject(\SchoolManagerBundle\Entity\Subject $subject = null)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return \SchoolManagerBundle\Entity\Subject 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Add mentors
     *
     * @param \SchoolManagerBundle\Entity\Mentor $mentors
     * @return Course
     */
    public function addMentor(\SchoolManagerBundle\Entity\Mentor $mentors)
    {
        $this->mentors[] = $mentors;

        return $this;
    }

    /**
     * Remove mentors
     *
     * @param \SchoolManagerBundle\Entity\Mentor $mentors
     */
    public function removeMentor(\SchoolManagerBundle\Entity\Mentor $mentors)
    {
        $this->mentors->removeElement($mentors);
    }

    /**
     * Get mentors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMentors()
    {
        return $this->mentors;
    }

    /**
     * Add students
     *
     * @param \SchoolManagerBundle\Entity\Student $students
     * @return Course
     */
    public function addStudent(\SchoolManagerBundle\Entity\Student $students)
    {
        $this->students[] = $students;

        return $this;
    }

    /**
     * Remove students
     *
     * @param \SchoolManagerBundle\Entity\Student $students
     */
    public function removeStudent(\SchoolManagerBundle\Entity\Student $students)
    {
        $this->students->removeElement($students);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudents()
    {
        return $this->students;
    }
}
