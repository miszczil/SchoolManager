<?php

namespace SchoolManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SchoolManagerBundle\Entity\Subject;

/**
 * @Route("/subjects")
 */
class SubjectController extends Controller
{
    /**
     * @Route("/new", name="newSubject")
     * @Template()
     */
    public function newAction(Request $request) {
        
        $subject = new Subject();
        
        $form = $this->createFormBuilder($subject)
                ->setMethod("POST")
                ->add("name", "text")
                ->add("description", "textarea")
                ->add("suggestedStudentAge", "text")
                ->add("hourlyRateForMentor", "number")
                ->add("save", "submit", array("label"=>"Add"))
                ->getForm();
                
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('showAllSubjects');
        }
        
        return array("form" => $form->createView());    
        
    }
    /**
     * @Route("/", name="showAllSubjects")
     * @Template()
     */
    public function showAllAction() {
        $repo = $this->getDoctrine()->getRepository("SchoolManagerBundle:Subject");
        $allSubjects = $repo->findAll();
        
        return array("allSubjects" => $allSubjects);
    }
    
    
    /**
     * @Route("/update/{id}", name="updateSubject")
     * @Template()
     */
    public function updateAction(Request $request, $id) {
        $repo = $this->getDoctrine()->getRepository("SchoolManagerBundle:Subject");
        $subject = $repo->find($id);
        
        if (!$subject) {
            throw $this->createNotFoundException('No subject found');
        }
        
        $form = $this->createFormBuilder($subject)
                ->setMethod("POST")
                ->add("name", "text")
                ->add("description", "textarea")
                ->add("suggestedStudentAge", "text")
                ->add("hourlyRateForMentor", "number")
                ->add("save", "submit", array("label"=>"Update"))
                ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('showAllSubjects');
        }
        
        return array("form" => $form->createView()); 
        
    }
    

    /**
     * @Route("/delete/{id}", name="deleteSubject")
     * @Template()
     */
    public function deleteAction(Request $request, $id) {
            
        $repo = $this->getDoctrine()->getRepository("SchoolManagerBundle:Subject");
        $subject = $repo->find($id);
        
        if (!$subject) {
            throw $this->createNotFoundException('No subject found');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($subject);
        $em->flush();

        return $this->redirect($this->generateUrl('showAllSubjects'));
    }
}
