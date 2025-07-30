<?php

namespace E05\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use E03\Bundle\Entity\Post;
use E05\Bundle\Entity\Likes;
use E05\Bundle\Entity\Dislikes;


class ReputationController extends Controller
{
    /**
     * @Route("/post/like/{id}", name="post_like", requirements={"id"="\d+"})
     */
    public function like($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository(Post::class)
            ->find($id);

        $user = $this->getUser();
        $existing = $em->getRepository(Likes::class)->findOneBy([
            'post' => $post,
            'user' => $user,
        ]);


        if ($existing) {
            $this->addFlash('warning', 'You already liked this post.');
            return $this->redirectToRoute('post_show', ['id' => $id]);
        }

        $like = new Likes();
        $like->setUser($user);
        $like->setPost($post);
        $em->persist($like);
        $em->flush();
        
        $this->addFlash('success', 'like given');
        return $this->redirectToRoute('post_show', ['id' => $id]);
    }

    /**
     * @Route("/post/dislike/{id}", name="post_dislike", requirements={"id"="\d+"})
     */
    public function dislike($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)
            ->find($id);
        $user = $this->getUser();
        $existing = $em->getRepository(Dislikes::class)->findOneBy([
            'post' => $post,
            'user' => $user,
        ]);

        if ($existing) {
            $this->addFlash('warning', 'You already disliked this post.');
            return $this->redirectToRoute('post_show', ['id' => $id]);
        }

        $like = new Dislikes();
        $like->setUser($user);
        $like->setPost($post);
        $em->persist($like);
        $em->flush();

        $this->addFlash('success', 'dislike given');
        return $this->redirectToRoute('post_show', ['id' => $id]);
    }

}
