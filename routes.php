<?php
require './autoload.php';

Route::get("/", function() {
    Home::index();
});

Route::get("/about", function() {
    About::index();
});
