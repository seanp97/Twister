<?php 
    inc_header();

    // Set title
    Title('Home Page');
?>

<h5>Home</h5>

<h4><?php echo Home::hello(); ?></h4>

<?php LoadPartial('hello'); ?>

<?php inc_footer(); ?>