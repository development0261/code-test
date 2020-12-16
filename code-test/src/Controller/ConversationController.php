<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Repository\CommunityRepository;

class ConversationController
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
     * @return \InSided\GetOnBoard\Entity\Post|null
     *
     * POST
     *
     */
    public function createAction($userId, $communityId, $title, $text)
    {
      $community = CommunityRepository::getCommunity($communityId);
      if($community) {
        $post = $community->addPost($title, $text, 'conversation', $userId, $communityId);
        return $post;
      }
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
    public function updateAction($userId, $communityId, $conversationId, $title, $text)
    {
      $user = CommunityRepository::getUser($userId);
      if($user) {
        $community = CommunityRepository::getCommunity($communityId);
        // Community exists.
        if($community) {
          // Get Posts from. Or we can find specified Post using articalId.
          $posts = $community->getPost($conversationId, $userId);
          // Post exists
          if($posts) {
            $post = $community->updatePost($conversationId, $title, $text);
          }
        }
      } else {
        return false;
      }
      return $post;
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
    public function deleteAction($userId, $communityId, $conversationId)
    {
      $user = CommunityRepository::getUser($userId);
      if($user) {
        $community = CommunityRepository::getCommunity($communityId);
        if($community) {
          // Get Posts from. Or we can find specified Post using articalId.
          $posts = $community->getPost($conversationId, $userId);
          if($posts) {
            $community->deletePost($conversationId, $userId);
          }
        }
      }

      return null;
    }

    /**
     * @param $communityId
     * @param $title
     * @param $text
     * @return mixed
     *
     * POST
     */
    public function commentAction($userId, $communityId, $conversationId, $text)
    {
      $community = CommunityRepository::getCommunity($communityId);
      if($community) {
        $comment = $community->addComment($conversationId, $text, $userId, 'conversion');
      }
      return $comment;
    }
}
