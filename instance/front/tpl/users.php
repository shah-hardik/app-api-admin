<div  class="moduleActionBar col-lg-12 col-md-12">
    <div>
        <nav class="navbar navbar-default " role="navigation">
            <div class="collapse navbar-collapse navbar-ex1-collapse  ">
                <ul class="nav navbar-nav">
                    <li class="<?php print $activeMenuList ?>"><a href="<?php print _U ?>users"><i class="glyphicon glyphicon-th-list"></i>&nbsp;Users List</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="clearfix "></div>

<div class="clearfix "></div>
<?php include $subTpl; ?>

<?php include_once('message.php') ?>
