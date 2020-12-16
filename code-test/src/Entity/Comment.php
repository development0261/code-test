<?php

namespace Task\GetOnBoard\Entity;

class Comment
{
    public $id;
    public $userid;
    public $type;
    public $text;
    public $deleted;

    public function __construct()
    {
        $this->id =  uniqid();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
      return $this->type;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setDeleted($text)
    {
        $this->deleted = $deleted;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }
}
