<?php //index.php is the last resort template, if no other templates match ?>
<?php get_header(); ?>
<main class="upatesPage">
<div class="container updatesContainer">
  <h1>Shop Updates</h1>

<div class="content ">
    <?php get_template_part( 'loop', 'index' );	?>
</div> <!--/.content -->


</div> <!-- /.container -->

</main>
  

<?php get_footer(); ?>