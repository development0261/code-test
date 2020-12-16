<?php

namespace Task\GetOnBoard\Entity;

use Task\GetOnBoard\Entity\Post;
use Task\GetOnBoard\Repository\CommunityRepository;

class Community
{
    public $id;
    public $name;
    public $posts = [];

    public function __construct()
    {
        $this->id =  uniqid();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param $title
     * @param $text
     * @param $type
     * @param null $parent
     * @return Post|null
     */
    public function addPost($title, $text, $type, $userId, $communityId, $parent = null)
    {
        $post = null;

        if ($type == 'article') {
            $post = new Post();
            $post->setUserId($userId);
            $post->setCommunityId($communityId);
            $post->setTitle($title);
            $post->setText($text);
            $post->setType($type);
        }

        if ($type == 'conversation') {
            $post = new Post();
            $post->setUserId($userId);
            $post->setCommunityId($communityId);
            $post->setText($text);
            $post->setType($type);

            if ($parent) {
                $post->setParent($parent);
            }
        }

        if ($type == 'question') {
            $post = new Post();
            $post->setUserId($userId);
            $post->setCommunityId($communityId);
            $post->setTitle($title);
            $post->setText($text);
            $post->setType($type);

            if ($parent) {
                $post->setParent($parent);
            }
        }

        $this->posts[] = $post;

        return $post;
    }

    /**
     * @param $id
     * @param $title
     * @param $text
     * @return mixed|null
     */
    public function updatePost($id, $title, $text)
    {
        $post = null;
        foreach ($this->posts as $post) {
            if ($post->id == $id) {
                $post->setTitle($title);
                $post->setText($text);

                $this->posts[] = $post;

                return $post;
            }
        }
    }

    /**
     * @param $id
     * @param $text
     * @param $userId
     * @param $type
     * @return null
     */
    public function addComment($parentId, $text, $userId, $type)
    {
      $post = null;
      foreach ($this->posts as $post) {
        if ($post->id == $parentId && $post->commentsAllowed == true) {
          $comment = $post->addComment($text, $userId, $type);
          return $comment;
        }
      }
    }

    /**
     * @param $id
     */
    public function deletePost($id, $userId)
    {
      foreach ($this->posts as $post) {
        if ($post->id == $id && $post->userid == $userId) {
          $post->setDeleted(true);
        }
      }
    }

    /**
     * @return array
     */
    public function getPosts()
    {
      $posts = [];
      foreach ($this->posts as $post) {
        if ($post->deleted == false) {
          $user = CommunityRepository::getUser($post->userId);
          $posts[] = $post;
          $post['user'];
          if($user) {
            $post['user'] = $user;
          }
        }
      }
      return $posts;
    }

    /**
     * @return array
     */
    public function getPost($id, $userId)
    {
      $posts = null;
      foreach (self::$posts as $post) {
        if ($post->id == $id && $post->userId == $userId) {
          return $post;
        }
      }
    }

    /**
     * @param $articleId
     * return void
     */
    public function disableCommentsForArticle($articleId): void
    {
      $post = null;
      foreach ($this->posts as $post) {
        if ($post->id == $articleId) {
          $post->setCommentsAllowed(false);
          $comment = new Comment();
          $comment->setDeleted(true);
        }
      }
    }
}
