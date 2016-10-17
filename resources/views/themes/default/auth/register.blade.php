<?php include __DIR__ . '/../layouts/header.blade.php' ?>
<style>
    html,body{
        height: 100%;
    }
    .form-group:last-child{
        margin-bottom: 0;
    }
    </style>
<div class="login-bg">
    <div class="container bs-docs-container">
        <section class="content">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="login-form" class="login-form text-center">
                        <div class="tab-content">

                            <form class="m-t" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control login-field" placeholder="请输入您的手机号" id="register-mobile" name="mobile">
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control login-field" placeholder="请输入不少于6位的密码" id="register-password" name="password">
                                </div>
                                <div class="form-group clearfix">
                                    <input class="form-control mobile-code"  name="mobile_code" type="text" placeholder="校验码是4位数字">
                                    <button type="submit" class="btn btn-default send-code">获取验证码</button>
                                </div>

                                <div class="form-group">
                                <button type="submit" class="btn btn-default btn-block">注册</button>
                                </div>


                                <p class="text-muted text-center">
                                    <a href="/auth/forget-password"><small>忘记密码？</small></a> |
                                    <a href="/auth/login"><small>立即登录</small></a>
                                </p>

                                <div class="form-group margin-t-15 clearfix">
                                    <a href="/auth/qq" class="btn btn-default btn-social btn-qq"><i class="fa fa-qq"></i> QQ登录</a>
                                    <a href="/auth/weibo" class="btn btn-default btn-social btn-weibo"><i class="fa fa-weibo"></i>微博登录</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
  </body>
<?php include __DIR__ . '/../layouts/footer.blade.php' ?>
<script>
    $(function () {
        var h = ($(window).height() - $('#login-form').height()) / 2;
        $('#login-form').css('margin-top',h);
        console.log(h);

    })

</script>