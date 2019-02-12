<section class="container">
    <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">

                <?php
                foreach ($list as $lt) {
                    $img_src=$lt->file_path.$lt->file_name;
                    ?>
                    <a class="oflow-hidden pos-relative mb-20 dplay-block" href="/saebom/board/view/<?=$lt->idx;?>">
                        <div class="wh-110x abs-tlr"><img src="<?=$img_src?>" alt="" style="width: 100%;"></div>
                        <div class="ml-120 min-h-100x">
                            <h2 class="post-title"><?=$lt->subject;?></h2>
                            <p class="post-subtitle">
                                <?php
                                $content = strip_tags ($lt->content);
                                echo $content;?>
                            </p>
                            <p class="post-meta"><?=$lt->category;?> | Posted on
                                <?=$lt->wrt_datetime;?></p>
                        </div>
                    </a>
                    <hr>
                    <?php
                }
                ?>
                <?=$pagination?>
            </div>
    </div>
    <hr>
</section>
Leave a Comment: