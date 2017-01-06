<?php
/* @var $this ReposController */

$this->breadcrumbs=array(
	'Repository',
);
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3><?php echo $full_name?></h3>
            <p>Description: <?php echo $description;?></p>
            <br>
            <p>Watchers: <?php echo $watchers_count;?></p>
            <p>Froks: <?php echo $forks_count;?></p>
            <p>Open issues: <?php echo $open_issues_count?></p>
            <p>Homepage: <a href="<?php echo $homepage?>"><?php echo $homepage;?></a></p>
            <p>GitHub repo: <a href="<?php echo $html_url?>"><?php echo $html_url;?></a></p>
            <p>Created at: <?php echo $created_at?></p>
        </div>
        <div class="col-md-6" id="contributors" >
            <h3>Contributors</h3>
        </div>
    </div>
</div>
<script>

    function like(id) {
        var cl = '#'+id;
        if ($(cl).children('span').hasClass('glyphicon-thumbs-up')) {
            $(cl).children('span').removeClass('glyphicon-thumbs-up');
            $(cl).children('span').addClass('glyphicon-thumbs-down');
        } else {
            $(cl).children('span').removeClass('glyphicon-thumbs-down');
            $(cl).children('span').addClass('glyphicon-thumbs-up');
        }

        var id = $(cl).children('input[name=iduser]').val();
        var login = $(cl).children('input[name=login]').val();
        $.ajax({
            url: '?r=user/like&id=' + id + '&login=' + login
        }).done(function (data) {
            console.log(data);

        });
    }

    $(document).ready(function () {

        $.ajax({
            url: '<?php echo $contributors_url;?>',
        }).done(function(data) {
            var i = 0;
            for(i = 0; i < data.length; i++) {
                $.ajax({
                    url: '?r=user/check&id='+data[i].id,
                    async:false,
                    context: document.body
                }).done(function (resp) {
                    data.like = resp;
                });

                data[i].like = data.like;
                var thumbs = data[i].like == 0 ? ' glyphicon-thumbs-up ' : ' glyphicon-thumbs-down ';
                $('#contributors').append("<a href=\'?r=user&name="+data[i].login+"\'>"+data[i].login+"</a><button id='"+i+"' onclick='like("+i+")'  class='btn btn-xs fingerUser'>"+
                    "<input type='hidden' name='iduser' value='"+data[i].id+"'>"+
                    "<input type='hidden' name='login' value='"+data[i].login+"'>"+
                    "<span class='glyphicon "+thumbs+"' aria-hidden='true'></span>"+
                    "</button><br>");
            }
        });



    });
</script>