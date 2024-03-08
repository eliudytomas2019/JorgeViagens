<?php
class SEO{
    private $title, $description, $keywords, $robots, $canonical, $author;

    public function __construct($title, $description = null, $keywords = null, $robots = null, $canonical = null, $author = null){
        $this->title = strip_tags(trim($title));
        $this->description = strip_tags(trim($description));
        $this->keywords = strip_tags(trim($keywords));
        $this->robots = strip_tags(trim($robots));
        $this->canonical = strip_tags(trim($canonical));
        $this->author = strip_tags(trim($author));
    }

    public function metaTags(){
        echo "<title>{$this->title}</title>";
        echo "<meta name='description' content='{$this->description}'/>";
        echo "<meta name='keywords' content='{$this->keywords}'/>";
        echo "<meta name='robots' content='{$this->robots}'/>";
        echo "<link rel='canonical' href='{$this->canonical}'/>";
        echo "<meta name='author' content='{$this->author}'/>";
    }
}