<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Repository\CommunityRepository;

class QuestionController
{
    /**
     * @param $communityId
     * @return array
     *
     * POST
     */
    public function listAction($communityId)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $posts = $community->getPosts();

        return $posts;
    }

    /**
     * @param $communityId
     * @param $title
     * @param $text
     *
     * @return
     *
     * POST
     *
     */
    public function createAction($userId, $communityId, $title, $text)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $post = $community->addPost($title, $text, 'question', $userId, $communityId);

        /*$user = CommunityRepository::getUser($userId);
        $user->addPost($post);*/

        return $post;
    }

    /**
     * @param $communityId
     * @param $title
     * @param $text
     *
     * @return mixed
     *
     * PUT
     *
     */
    public function updateAction($userId, $communityId, $questionId, $title, $text)
    {
        // Get User from the repository.
        // Assume we will have unique users only.
        // Assume we get UserId in $user variable.
        $user = CommunityRepository::getUser($userId);
        // User exists.
        if($user) {
          $community = CommunityRepository::getCommunity($communityId);
          // Community exists.
          if($community) {
            // Get Posts from. Or we can find specified Post using questionId.
            $posts = $community->getPost($questionId, $userId);
            // Post exists
            if($posts) {
              $post = $community->updatePost($questionId, $title, $text);
            }
          }
        } else {
          return false;
        }
        return $post;
        /*$user = CommunityRepository::getUser($userId);
        foreach ($user->getPosts() as $userPost) {
          if ($userPost->id == $questionId) {
            $community = CommunityRepository::getCommunity($communityId);
            $post = $community->updatePost($questionId, $title, $text);
          }
        }
        return $post;*/
    }

    /**
     * @param $communityId
     * @param $title
     * @param $text
     *
     * @return null
     *
     * DELETE
     */
    public function deleteAction($userId, $communityId, $questionId)
    {
      $user = CommunityRepository::getUser($userId);
      if($user) {
        $community = CommunityRepository::getCommunity($communityId);
        if($community) {
          // Get Posts from. Or we can find specified Post using articalId.
          $posts = $community->getPost($questionId, $userId);
          if($posts) {
            $community->deletePost($questionId, $userId);
          }
        }
      }
      return null;
      /*$user = CommunityRepository::getUser($userId);
      foreach ($user->getPosts() as $userPost) {
          if ($userPost->id == $questionId) {
              $community = CommunityRepository::getCommunity($communityId);
              $community->deletePost($questionId);
          }
      }

      return null;*/
    }

    /**
     * @param $communityId
     * @param $title
     * @param $text
     * @return mixed
     *
     * POST
     */
    public function commentAction($userId, $communityId, $questionId, $text)
    {
      $community = CommunityRepository::getCommunity($communityId);
      if($community) {
        $comment = $community->addComment($questionId, $text, $userId, 'question');
      }

      return $comment;
    }
}
