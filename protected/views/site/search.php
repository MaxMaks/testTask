
<?php
$this->breadcrumbs=array(
    'Search',
);

foreach ($repos as $repo){?>
    <div class="panel panel-info clearfix">
        <div class="panel-heading">
            <h3 class="panel-title"><a href="?r=repos&name=<?php echo $repo['name'];?>&login=<?php echo $repo['owner']['login'];?>"><?php echo $repo['name'];?></a></h3>
        </div>
        <div class="panel-body">
            <h4>Author: <a href="?r=user&name=<?php echo $repo['owner']['login']?>"><?php echo $repo['owner']['login']?></a></h4>
           <?php if($repo['homepage']) echo "<p>Homepage: <a href='".$repo['homepage']."'>".$repo['homepage']."</a></p><br>";?>
            <?php if($repo['description']) echo "<p class='description'>Description:<br><em>".$repo['description']."</em></p>";?>
            <p><small><span>Watchers: <?php echo $repo['watchers_count'];?> </span><span>Forks: <?php echo $repo['forks_count'];?></span></small></p>

        </div>
        <button  class="btn btn-lg btn-primary finger pull-right">
            <input type="hidden" name="idrepo" value="<?php echo $repo['id'];?>">
            <input type="hidden" name="name" value="<?php echo $repo['name'];?>">
            <input type="hidden" name="login" value="<?php echo $repo['owner']['login'];?>">
            <span class="glyphicon <?php if($repo['like'] == 1) echo ' glyphicon-thumbs-down ';else echo ' glyphicon-thumbs-up ';?>" aria-hidden="true"></span>
        </button>
    </div>
<?php }?>
<a <?php if(!$paginator->hasPrevious()) echo " disabled ";?> id="previousPage" class="btn btn-lg glyphicon glyphicon-chevron-left" aria-hidden="true"></a><a id="nextPage" class="pull-right btn btn-lg glyphicon glyphicon-chevron-right" aria-hidden="true" <?php if(!$paginator->hasNext()) echo ' disabled ';?> ></a>
<script>
    function get(url,name){
        if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(url))
            return decodeURIComponent(name[1]);
    }
        var query = get(location.search,'query');
        var newpage = '<?php $next = $paginator->getPagination(); if($paginator->hasNext()) echo $next['next'];?>';
        var nextNumber = get(newpage,"page");
        $('#nextPage').attr('href','?r=site/next&query='+query+'&number='+nextNumber);
        var prevpage = '<?php $previous = $paginator->getPagination(); if($paginator->hasPrevious()) echo $previous['prev'];?>';
        var previousNumber = get(prevpage,"page");
        $('#previousPage').attr('href','?r=site/next&query='+query+'&number='+previousNumber);
</script>