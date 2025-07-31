<?php

namespace E06\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use E03\Bundle\Entity\Post;
use E06\Bundle\Form\PostType;

class PostEditController extends Controller
{
    /**
     * @Route("/post/edit/{id}", name="post_edit", requirements={"id"="\d+"})
     */
    public function editPost(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            throw $this->createNotFoundException('Post not found');
        }

        $form = $this->createForm(new PostType(), $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setLastEdit(new \DateTime());
            $post->setLastEditedBy($this->getUser()); // requires user to be logged in

            $em->flush();

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        return $this->render('@E06/edit.html.twig', [
            'form' => $form->createView(),
            'post' => $post,
        ]);
    }
}


?>