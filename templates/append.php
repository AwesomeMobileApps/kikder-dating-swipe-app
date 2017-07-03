<?php foreach ($users as $user): ?>
    <li class="buddy col-md-4 col-md-offset-4" id="<?php echo $user->user_id; ?>"
        data-like-id="<?php echo $user->user_id ?>" style="display: block;">
        <div style="position: relative; width: 100%;">
            <img class="img-responsive" style="display: block; width: 100%;" src="<?php echo $user->user_picture; ?>">
            <div class="yes"></div>
            <div class="no"></div>
            <div class="buddy-info">
                <h4><a href="kik://<?php echo $user->user_name; ?>"><?php echo $user->user_name; ?></a></h4>
            </div>
            <div class="like">Would Kik</div>
            <div class="dislike">Would Not Kik</div>
        </div>
    </li>
<?php endforeach; ?>