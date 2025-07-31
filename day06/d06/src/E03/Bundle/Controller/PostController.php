<?php

namespace E03\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use E03\Bundle\Entity\Post;
use E06\Bundle\Form\PostType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PostController extends Controller
{
    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    /**
     * @Route("/post/{id}", name="post_show", requirements={"id"="\d+"})
     */
    public function showAction($id)
    {
        $post = $this->getDoctrine()
                     ->getRepository(Post::class)
                     ->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Post not found.');
        }

        return $this->render('@E03/post/show.html.twig', [
            'post' => $post,
            'id' => $id,
        ]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/post/new", name="post_new")
     */
    public function newAction(Request $request)
    {
        $post = new Post();
        $post->setCreated(new \DateTime());
        $post->setAuthor($this->getUser());

        // using FormType of E06
        $form = $this->createForm(new PostType(), $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $this->addFlash('success', 'Post created successfully.');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('@E03/post/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

?>