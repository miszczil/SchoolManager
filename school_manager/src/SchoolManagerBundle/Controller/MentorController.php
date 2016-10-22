<?php

namespace SchoolManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SchoolManagerBundle\Entity\Mentor;

    /**
     * @Route("/mentors")
     */
class MentorController extends Controller
{    
    /**
     * @Route("/", name="showAllMentors")
     * @Template()
     */
    public function showAllAction() {
        $repo = $this->getDoctrine()->getRepository("SchoolManagerBundle:Mentor");
        $allMentors = $repo->findAll();
        
        return array("allMentors" => $allMentors);
    }
    
    /**
     * @Route("/update/{id}", name="updateMentor")
     * @Template()
     */
    public function updateAction(Request $request, $id) {
        $repo = $this->getDoctrine()->getRepository("SchoolManagerBundle:Mentor");
        $mentor = $repo->find($id);
        
        if (!$mentor) {
            throw $this->createNotFoundException('No mentor found');
        }
        
        $form = $this->createFormBuilder($mentor)
                ->setMethod("POST")
                ->add("name", "text")
                ->add("email", "email")
                ->add("phone", "text")
         
                ->add("canTeach", "entity",
                      array("class" => "SchoolManagerBundle:Subject",
                            "choice_label" => "name",
                            "placeholder" => "",
                            "multiple" => true,
                            "expanded" => true))
                ->add("save", "submit", array("label"=>"Update"))
                ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('showAllMentors');
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
