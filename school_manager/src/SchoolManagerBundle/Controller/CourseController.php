<?php

namespace SchoolManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SchoolManagerBundle\Entity\Course;

/**
 * @Route("/courses")
 * 
 */
class CourseController extends Controller
{
    /**
     * @Route("/new", name="newCourse")
     * @Template()
     */
    public function newAction(Request $request) {
        
        $course = new Course();
        
        $form = $this->createFormBuilder($course)
                ->setMethod("POST")
                ->add("subject", "entity",
                      array("class" => "SchoolManagerBundle:Subject",
                            "choice_label" => "name",
                            "placeholder" => ""))
                ->add("location", "text")
                ->add("weekday", "text")
                ->add("starttime", "text")
                ->add("endtime", "text")
                ->add("numOfMeetings", "number")
                ->add("save", "submit", array("label"=>"Add"))
                ->getForm();
                
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('showAllCourses');
        }
        
        return array("form" => $form->createView());    
        
    }
    /**
     * @Route("/", name="showAllCourses")
     * @Template()
     */
    public function showAllAction() {
        $repo = $this->getDoctrine()->getRepository("SchoolManagerBundle:Course");
        $allCourses = $repo->findAll();
        
        return array("allCourses" => $allCourses);
    }
    
    /**
     * @Route("/{id}", name="showCourse")
     * @Template()
     */
    public function showAction($id) {
        $repo = $this->getDoctrine()->getRepository("SchoolManagerBundle:Course");
        $course = $repo->find($id);
        
        return array("course" => $course);
    }
    
    /**
     * @Route("/update/{id}", name="updateCourse")
     * @Template()
     */
    public function updateAction(Request $request, $id) {
        $repo = $this->getDoctrine()->getRepository("SchoolManagerBundle:Course");
        $course = $repo->find($id);
        
        if (!$course) {
            throw $this->createNotFoundException('No course found');
        }
        
        $form = $this->createFormBuilder($course)
                ->setMethod("POST")
                ->add("subject", "entity",
                      array("class" => "SchoolManagerBundle:Subject",
                            "choice_label" => "name",
                            "placeholder" => ""))
                ->add("location", "text")
                ->add("weekday", "text")
                ->add("starttime", "text")
                ->add("endtime", "text")
                ->add("numOfMeetings", "number")
                ->add("save", "submit", array("label"=>"Update"))
                ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('showAllCourses');
        }
        
        return array("form" => $form->createView()); 
        
    }
    
    /**
     * @Route("/test", name="test")
     * @Template()
     */
    public function testAction(Request $request) {
        
        $mentorRepo = $this->getDoctrine()->getRepository("SchoolManagerBundle:Mentor");
        $subjectRepo = $this->getDoctrine()->getRepository("SchoolManagerBundle:Subject");
        $sub = $subjectRepo->find(2);
        
        $mentors = $mentorRepo->getAllMentorsWhoTeachThisSubject($sub);
        
        dump($mentors);
        
        die("me222");
        
    }
    
    /**
     * @Route("/{id}/addMentor", name="addMentorToCourse")
     * @Template()
     */
    public function addMentorAction(Request $request, $id) {
        $repo = $this->getDoctrine()->getRepository("SchoolManagerBundle:Course");
        $course = $repo->find($id);
        
        if (!$course) {
            throw $this->createNotFoundException('No course found');
        }
        
        $subject = $course->getSubject();
        
        $form = $this->createFormBuilder($course)
                ->setMethod("POST")
                ->add("mentor", "entity",
                      array("class" => "SchoolManagerBundle:Mentor",
                           'query_builder' => function (MentorRepository $mr) {
                                return $mr->getAllMentorsWhoTeachThisSubject($subject);
                            },
                            "choice_label" => "name",
                            "placeholder" => "",
                            "expanded" => true))
                ->add("save", "submit", array("label"=>"Choose mentor"))
                ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('showAllCourses');
        }
        
        return array("form" => $form->createView()); 
        
    }
    

    /**
     * @Route("/delete/{id}", name="deleteCourse")
     * @Template()
     */
    public function deleteAction(Request $request, $id) {
            
        $repo = $this->getDoctrine()->getRepository("SchoolManagerBundle:Course");
        $course = $repo->find($id);
        
        if (!$course) {
            throw $this->createNotFoundException('No course found');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($course);
        $em->flush();

        return $this->redirect($this->generateUrl('showAllCourses'));
    }
}


