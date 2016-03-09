<?php
class Article
{
    private $id;
    private $title;
    private $content;
    private $intro;

    function __construct($id, $title, $content, $intro)
    {
        $this->id=$id;
        $this->title=$title;
        $this->content=$content;
        $this->intro=$intro;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getIntro()
    {
        return $this->intro;
    }
}

class Image
{
    private $id;
    private $name;
    private $click;
    private $id_article;

    function __construct($id, $name, $click, $id_article)
    {
        $this->id=$id;
        $this->name=$name;
        $this->click=$click;
        $this->id_article=$id_article;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getClick()
    {
        return $this->click;
    }
    public function getIdArticle()
    {
        return $this->id_article;
    }
}
class User
{
    private $id;
    private $login;
    private $password;
    private $role;

    function __construct($id, $login, $password, $role)
    {
        $this->id=$id;
        $this->login=$login;
        $this->password=$password;
        $this->role=$role;
    }
}