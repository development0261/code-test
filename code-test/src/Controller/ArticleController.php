<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Repository\CommunityRepository;

class ArticleController
{
    /**
     * @param $communityId
     * @return array
     *
     */
    public function listAction($communityId)
    {
        $community = CommunityRepository::getCommunity($communityId);
        if($community) {
          $posts = $community->getPosts();
          return $posts;
        }
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
        if($community) {
          $post = $community->addPost($title, $text, 'article', $userId, $communityId);
        }
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
    public function updateAction($userId, $communityId, $articleId, $title, $text)
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
          // Get Posts from. Or we can find specified Post using articalId.
          $posts = $community->getPost($articalId, $userId);
          // Post exists
          if($posts) {
            $post = $community->updatePost($articleId, $title, $text);
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
    public function deleteAction($userId, $communityId, $articleId)
    {
      $user = CommunityRepository::getUser($userId);
      if($user) {
        $community = CommunityRepository::getCommunity($communityId);
        if($community) {
          // Get Posts from. Or we can find specified Post using articalId.
          $posts = $community->getPost($articleId, $userId);
          if($posts) {
            $community->deletePost($articleId, $userId);
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
    public function commentAction($userId, $communityId, $articleId, $text)
    {
      $community = CommunityRepository::getCommunity($communityId);
      if($community) {
        $comment = $community->addComment($articleId, $text, $userId, 'article');
      }

      return $comment;
    }

    /**
     * @param $communityId
     * @param $articleId
     *
     * PATCH
     */
    public function disableCommentsAction($communityId, $articleId)
    {
      $community = CommunityRepository::getCommunity($communityId);
      if($community) {
        $community->disableCommentsForArticle($articleId);
      }
    }
}
