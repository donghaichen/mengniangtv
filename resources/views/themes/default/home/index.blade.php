<?php include __DIR__ . '/../layouts/header.blade.php' ?>

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


    <div class="row">
<?php foreach($video as $v) {?>
        <div class="col-sm-6 col-md-4 col-lg-3 ">
            <div class="thumbnail">
                <a><img width="300" height="150" ></a>
                <div class="caption">
                    <h3>
                        <a><?php echo $v['title']?></a>
                    </h3>
                    <p>
                        <?php echo $v['content']?>
                    </p>
                </div>
            </div>
        </div>
<?php } ?>



    </div>
</div><!-- /.container -->


<?php include __DIR__ . '/../layouts/footer.blade.php' ?>