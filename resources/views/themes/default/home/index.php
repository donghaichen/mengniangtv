<?php load('layouts.header') ?>
<div class="jumbotron masthead">
    <div class="container">
        <h1>MENGNIANG.TV</h1>
        <script type="text/javascript" src="http://ip.chinaz.com/getip.aspx"></script>
        <p class="masthead-button-links">
            <a class="btn btn-lg btn-primary btn-shadow" >Let's   🐶🐶🐶🐶🐶🐶🐶🐶🐶🐶🐶🐶🐶</a>
        </p>

    </div>
</div>



<div class="container projects">

    <form method="post">
        <p>First name: <input type="text" name="fname" /></p>
        <p>Last name: <input type="text" name="lname" /></p>
        <input type="submit" value="Submit" />
    </form>
    <div class="row">
<?php
$users = self::$data;
//            var_dump($data);
            var_dump($users);
//            var_dump(self::$data);
         ?>



    </div>
</div><!-- /.container -->

<?php load('layouts.footer') ?>
