<?php

namespace Task\GetOnBoard\Entity;

class Post
{
  public $id;
  public $userId;
  public $communityId;
  public $title;
  public $text;
  public $type;
  public $parent;
  public $comments;
  public $deleted;
  public $commentsAllowed = true;

  /**
   * Post constructor.
   */
  public function __construct()
  {
    $this->id =  uniqid();
    $this->comments = [];
  }

  /**
   * @return string
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return int
   */
  public function getUserId()
  {
    return $this->userId;
  }

  /**
   * @param $userId
   */
  public function setUserId($userId): void
  {
    $this->userId = $userId;
  }

  /**
   * @return int
   */
  public function getCommunityId()
  {
    return $this->CommunityId;
  }

  /**
   * @param $communityId
   */
  public function setCommunityId($communityId): void
  {
    $this->communityId = $communityId;
  }

  /**
   * @return mixed
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * @param $title
   */
  public function setTitle($title): void
  {
    $this->title = $title;
  }

  /**
   * @return mixed
   */
  public function getText()
  {
    return $this->text;
  }

  /**
   * @param $text
   */
  public function setText($text): void
  {
    $this->text = $text;
  }

  /**
   * @return mixed
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * @param $type
   */
  public function setType($type): void
  {
    $this->type = $type;
  }

  /**
   * @return mixed
   */
  public function getParent()
  {
    return $this->parent;
  }

  /**
   * @param $parent
   */
  public function setParent($parent): void
  {
    $this->parent = $parent;
  }

  /**
   * @param $text
   * @return Comment
   */
  public function addComment($text, $userId, $type)
  {
    $comment = new Comment();
    $comment->setUserId($text);
    $comment->setType($text);
    $comment->setText($text);
    $comment->setDeleted(false);

    $this->comments[] = $comment;

    return $comment;
  }

  /**
   * @return array
   */
  public function getComments(): array
  {
    return $this->comments;
  }

  /**
   * @return mixed
   */
  public function getDeleted()
  {
    return $this->deleted;
  }

  /**
   * @param mixed $deleted
   */
  public function setDeleted($deleted): void
  {
    $this->deleted = $deleted;
  }

  /**
   * @return bool
   */
  public function isCommentsAllowed(): bool
  {
    return $this->commentsAllowed;
  }

  /**
   * @param mixed $commentsAllowed
   */
  public function setCommentsAllowed($commentsAllowed)
  {
    if (!$commentsAllowed) {
      $this->comments = [];
    }

    $this->commentsAllowed = $commentsAllowed;
  }
}
