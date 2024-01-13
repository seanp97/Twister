<?php
require './autoload.php';

Http::get("/", function() {
    Home::index();
});

Http::get("/about", function() {
    About::index();
});