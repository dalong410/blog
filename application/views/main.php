
<div id="wrapper">
<!---https://bootsnipp.com/snippets/WaeDX-->
    <section class="details-card">
        <div class="container">
            <div class="section-title text-center">
                <h4>BEST TOP</h4>
                <p class="post-meta" style="font-size: 28px;">BEST TOP : Most read 1 to 3</p>
            </div><!-- end section-title -->
            <div class="row">
                <?php
                $i = 1;
                foreach ($best_list as $b_lt) {
                    $img_src=$b_lt->file_path.$b_lt->file_name;
                ?>
                <div class="col-md-4">
                    <div class="card-content">
                        <div class="card-img">
                            <img src="<?=$img_src?>" alt="">
                            <span><h4>TOP <?=$i;?></h4></span>
                        </div>
                        <div class="card-desc">
                            <h3><?=$b_lt->subject;?></h3>
                            <p>
                                <?php
                                $content = strip_tags ($b_lt->content);
                                echo $content;
                                ?>
                            </p>
                            <a href="/saebom/board/view/<?=$b_lt->idx;?>"  class="btn-card">Read</a>
                        </div>
                    </div>
                </div>
                <?php
                    $i++;
                }
                ?>
            </div>
        </div>
    </section>
</div><!-- end wrapper -->
