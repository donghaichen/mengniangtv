<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

<?php echo $title?>

</head>

<body>

<div class="article">


<?php foreach ($video as $v) {?>


    <li class="content">

<?php  echo $v['content']; ?>
        </li>
        <?php    }?>
    <?php echo $status ?>



</div>





</body>

</html>