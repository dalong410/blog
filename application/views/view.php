<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="mx-auto">
            <!-- Title -->
            <h1 class="mt-4"><?=$view['subject']?></h1>
            <hr>

            <!-- Date/Time -->
            <p><?=$view['category']?> | Posted on <?=$view['wrt_datetime']?></p>

            <hr>
            <!-- Post Content -->
            <p class="lead"><?=$view['content']?></p>

            <hr>

            <!-- Comments Form -->
            <div class="card mb-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form>
                        <div  class="d-flex mr-3 rounded-circle">
                            <select id="msComboTest">
                                <option value="" data-image="${ctx}/resource/images/lcs_null.gif" data-title="NULL"</option>
                                <option value="0" data-image="${ctx}/resource/images/lcs_blank.gif" data-title="BLANK">BLANK</option>
                                <option value="1" data-image="${ctx}/resource/images/lcs_o.gif" data-title="GREEN↓">GREEN↓</option>
                            </select>
                            <div class="form-group"  style="width:80%; margin-left: 10px; margin-right: 10px; margin-bottom:0;">
                                <input type="text" class="form-control" name="q" placeholder="name" style="width:20%" />
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Single Comment -->
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0">Commenter Name</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
