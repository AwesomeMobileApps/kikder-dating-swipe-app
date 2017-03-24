<div class="page"style="overflow:hidden;">
<div class="go" >
<div class="clearfix">
<div class="user">
    <img src="<?php echo User::userPicture();?>" class="img-circle" style="width: 35px; height: 35px;">
    <b><?php echo User::userName();?></b>
</div>
<div class="logo">
kik or not
</div>
<div class="links">
    <a href="<?php echo site_url('signout'); ?>">Sign out</a>
</div>
</div>
</div>
<div class="se-pre-con"></div>
<div class="container-fluid">
  <div class="clearfix"></div>
      <div class="how_to">
        Swipe <strong class="green">right</strong> if you'd Kik, or <strong class="red">left</strong> if you won't!
      </div>
<div id="container">

    <div class="row">
    <div id="tinderslide">
    <ul>
    <?php foreach($users as $user):?>
    <?php $picture = $user->user_picture;?>
 <li class="buddy col-md-4 col-md-offset-4 col-sm-12" id="<?php echo $user->user_id;?>" data-like-id="<?php echo $user->user_id ?>" style="display: block;">
             <div style="position: relative; width:100%;" class="color">
            <img class="img-responsive" style="display: block; width:100%;" src="<?php echo $picture;?>">
        <div class="yes"></div>
        <div class="no"></div>
               <div class="buddy-info">
                   <h4><?php echo $user->user_name;?></h4>
            </div>
            <div class="like">Would Kik</div><div class="dislike">Would Not Kik</div>
            </div>
        </li>
    <?php endforeach;?>
    </ul>
</div>


        </div>
  </div>
  </div>
  </div>

</div>