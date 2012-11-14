<?php

namespace Work\GuestBookBundle\Controller;

use Work\GuestBookBundle\Entity\TestClass;
use Work\GuestBookBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DefaultController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        return $this->render('WorkGuestBookBundle:Default:index.html.twig');
    }
    /**
     * @Route("/create")
     */
    public function createAction()
    {

        $post = new Post();
        $post->setTitle($_REQUEST['title']);
	$post->setBody($_REQUEST['body']);
	$post->setCreatedDate(new \DateTime("now"));
	$post->setUpdatedDate(new \DateTime('now'));

    $em = $this->getDoctrine()->getEntityManager();
	$em->persist($post);
	$em->flush();

        return $this->render('WorkGuestBookBundle:Default:show.html.twig', array('post'=>$post));
    }
    /**
     * @Route("/show/{id}")
     */
    public function showAction($id)
    {
        $post = $this->getDoctrine()->getRepository('WorkGuestBookBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Страница не найдена!');
        }

        return $this->render('WorkGuestBookBundle:Default:show.html.twig', array('post'=>$post));
    }

    /**
     * @Route("/show")
     */
    public function showAllAction()
    {
//        global $id_counter;
//        $cnt = $id_counter;
//        $stor = array();
//        while ($cnt>0) {
//            $id = $cnt;
//            --$id;
            $post = $this->getDoctrine()->getRepository('WorkGuestBookBundle:Post')->findAll();

            if (!$post) {
                throw $this->createNotFoundException('Страница не найдена!');
            }
  //          $stor[] = $post;
  //      }
        return $this->render('WorkGuestBookBundle:Default:show_all.html.twig', array('post'=>$post));
    }
    /**
     * @Route("/test")
     */
    public function testAction()
    { $Test = new TestClass();
      $Test->setTest('some_string');
      $Test->setBar('some_value');

        $form = $this->createFormBuilder($Test)
                       ->add('test','text')
                       ->add('bar','text')
                       ->getForm();

        return $this->render('WorkGuestBookBundle:Default:test.html.twig', array('form'=>$form->createView()));

//        $stor[] = array('username'=>'user_1','id'=>'1');
//        $stor[] = array('username'=>'user_2','id'=>'2');
//        $stor[] = array('username'=>'user_3','id'=>'3');
//        $stor[] = array('username'=>'user_4','id'=>'4');
//        return $this->render('WorkGuestBookBundle:Default:test.html.twig', array('stor'=>$stor));
    }
}
