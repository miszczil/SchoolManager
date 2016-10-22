<?php

namespace SchoolManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SchoolManagerBundle\Entity\Student;

/**
 * @Route("/students")
 * 
 */
class StudentController extends Controller
{
    
    /**
     * @Route("/new", name="newStudent")
     * @Template()
     */
    public function newAction(Request $request) {
        
        $student = new Student();
        
        $form = $this->createFormBuilder($student)
                ->setMethod("POST")
                ->add("name", "text")
                ->add("age", "number")
                ->add("parentsName", "text")
                ->add("parentsEmail", "text")
                ->add("parentsPhone", "text")
                ->add("course", "entity", array(
                            "class" => "SchoolManagerBundle:Course",
                            "placeholder" => ""))
                ->add("save", "submit", array("label"=>"Add"))
                ->getForm();
                
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('showAllStudents');
        }
        
        return array("form" => $form->createView());    
        
    }
    
     /**
     * @Route("/", name="showAllStudents")
     * @Template()
     */
    public function showAllAction() {
        $repo = $this->getDoctrine()->getRepository("SchoolManagerBundle:Student");
        $allStudents = $repo->findAll();
        
        return array("allCourses" => $allStudents);
    }
}
