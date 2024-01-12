<?php 

class Home {

    static function index() {
        // Load index.php file in views/Home folder
        view("Home/index");
    }

    static function hello() {
        return 'Hello World';
    }
}