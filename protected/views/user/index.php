<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	'User',
);
?>

<div class="container">
    <div class="thumbnail">
        <img src="<?php echo $avatar_url;?>" alt="...">
        <div class="caption clearfix">
            <h3><?php echo $name;?></h3>
            <p><?php echo $login;?></p>
            <p>Blog: <a href="<?php echo $blog;?>"><?php echo $blog;?></a></p>
            <p>Company: <?php echo $company;?></p>
            <p>Followers: <?php echo $followers;?></p>
            <button  class="btn btn-lg fingerUser pull-right">
                <input type="hidden" name="iduser" value="<?php echo $id;?>">
                <input type="hidden" name="login" value="<?php echo $login;?>">
                <span class="glyphicon <?php if($like == 1) echo ' glyphicon-thumbs-down ';else echo ' glyphicon-thumbs-up ';?>" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</div>