<section class="container">
    <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <?php
                foreach ($list as $lt) {
                    ?>
                    <div class="post-preview">
                        <a href="/saebom/board/view/<?=$lt->idx;?>">
                            <h2 class="post-title">
                                <?=$lt->subject;?>
                            </h2>
                            <h3 class="post-subtitle">
                                <?=$lt->content;?>
                            </h3>
                        </a>
                        <p class="post-meta"><?=$lt->category;?> | Posted on
                            <?=$lt->wrt_datetime;?></p>
                    </div>
                    <hr>
                    <?php
                }
                ?>
                <?=$pagination?>
            </div>
    </div>
    <!-- Pager -->
    <!--<div class="col-lg-8 col-md-10 mx-auto">
    <nav aria-label="Page navigation example">
        <ul class="pagination ">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
    </div>-->
    <hr>
</section>
