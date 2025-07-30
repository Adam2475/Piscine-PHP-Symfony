<?php

namespace E05\Bundle\Services;

class ReputationService
{
    public function getUserReputation($user)
    {
        $reputation = 0;
        foreach ($user->getPosts() as $post) {
            $reputation += count($post->getLikes()) - count($post->getDislikes());
        }
        return $reputation;
    }
}

?>