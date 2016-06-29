<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta name="description" content="" />
	<meta name="keywords" content="paginação jquery, paginação jquery quick pagination" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	
<script type="text/javascript" src="http://www.jquery4u.com/demos/jquery-quick-pagination/js/jquery.quick.pagination.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/styless.css">
<link rel="stylesheet" type="text/css" href="css/styles.css">

<script type="text/javascript">


/*breadcrumb function*/

<?php

function the_breadcrumb() {

      if ( !is_home() ) {

          echo '<div class="breadcrumbleft" ></div><div class="breadcrumb" > <a style="float: left; color: #555555;" href="';

          echo get_option('home');

          echo '">';

          echo '<img src="http://www.yoursite.com/wp-content/themes/your_themes/images/home.png" style="margin-top: 5px;"/>';

          echo "</a> <div class=\"arrowbread\" ></div> ";

          }

 

          if ( is_category() || is_single() ) {

               $category = get_the_category();

               $ID = $category[0]->cat_ID;

               echo '<div>'.get_category_parents($ID, TRUE, '', FALSE ).'</div>';

          }

 

          if(is_single()) {echo ' <div></div>';the_title();}

          if(is_page()) {the_title();}

          if(is_tag()){ echo "Tag: ".single_tag_title('',FALSE); }

          if(is_404()){ echo "404 - Page not Found"; }

          if(is_search()){ echo "Search"; }

          if(is_year()){ echo get_the_time('Y'); }            
 

          echo "</div><div class=\"breadcrumbright\" ></div><div class=\"clear\"></div>";

    }

?>

/*end*/


$(document).ready(function() {
	$("ul.pagination1").quickPagination();
	$("ul.pagination2").quickPagination({pagerLocation:"both"});
	$("ul.pagination3").quickPagination({pagerLocation:"both",pageSize:"3"});
});
</script>

<style type="text/css">
#content { background-color:white; }
</style>


<title>Tutorial Pagina&ccedil;&atilde;o com jQuery quick pagination - kadunew.com/blog</title>
</head>
<body onLoad="init()"  >
<div id="page-wrap">

		

  <div id="content">
<h1>Paginação com jQuery quick pagination</h1>
<p>Kadunew.com/blog</p>
<h2>Primeiro exemplo</h2>
<p>Opção padrão, mostrando  10 itens da lista e navegação na parte inferior.</p>
           <code>
        	<pre>
    $("ul.pagination1").quickPagination();
            </pre>
        </code>


<ul class="pagination1">
	<li>1 - Item 1 de 25</li>
    <li>2 - Item 2 de 25</li>
    <li>3 - Item 3 de 25</li>
    <li>4 - Item 4 de 25</li>
    <li>5 - Item 5 de 25</li>
    <li>6 - Item 6 de 25</li>

</ul>

<div class="clearing"></div>

            <code>
        	<pre>
   $("ul.pagination2").quickPagination({pagerLocation:"both"});
            </pre>
        </code>
	

 <ul class="pagination2">
	<li>1 - Item 1 de 25</li>
    <li>2 - Item 2 de 25</li>
    <li>3 - Item 3 de 25</li>
    <li>4 - Item 4 de 25</li>
    <li>5 - Item 5 de 25</li>
    <li>6 - Item 6 de 25</li>

</ul>

<div class="clearing"></div>

            <code>
        	<pre>
   $("ul.pagination3").quickPagination({pagerLocation:"both",pageSize:"3"});
            </pre>
        </code>
		
		
 <ul class="pagination3">
	<li>1 - Item 1 de 25</li>
    <li>2 - Item 2 de 25</li>
    <li>3 - Item 3 de 25</li>
    <li>4 - Item 4 de 25</li>
    <li>5 - Item 5 de 25</li>
    <li>6 - Item 6 de 25</li>

</ul>

<div class="clearing"></div>
<!-- end plugin html -->

	<p><strong>Referências:</strong></p>
<ul>
	<li><a href="http://www.jquery4u.com/tutorials/jquery-quick-pagination-list-items/">http://www.jquery4u.com/tutorials/jquery-quick-pagination-list-items/</a></li>

	<li><a href="http://archive.plugins.jquery.com/project/quick_paginate">http://archive.plugins.jquery.com/project/quick_paginate</a></li>
</ul>


</div>
			<div class="backtoblog"></div>
</div> <!-- end page wrap -->

</body>
</html>

