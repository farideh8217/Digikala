<?php
class controller{
    public function __construct()
    {
    }
    public function view($viewurl)
    {
        require ("header.php");
        require ("views/".$viewurl.".php");
        require ("footer.php");
    }
}