<link rel="stylesheet" type="text/css" href="/saebom/css/iconselect.css" >
<script type="text/javascript" src="/saebom/js/iconselect.js"></script>
<script type="text/javascript" src="/saebom/js/iscroll.js"></script>
<!-- Page Content -->
<div class="container">
    <div class="wrapper">
        <!-- Blog Entries Column -->
        <div class="mx-auto">
            <!-- Title -->
            <h1 class="mx-auto"><?=$view['subject']?></h1>
            <hr>

            <!-- Date/Time -->
            <p><?=$view['category']?> | Posted on <?=$view['wrt_datetime']?></p>

            <hr>
            <!-- Post Content -->
            <p class="lead"><?=$view['content']?></p>

            <hr>

            <!-- Comments Form -->
            <div class="card mx-auto">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <div  class="d-flex mr-3 rounded-circle">
                        <div class="form-group"  style="width:80%; margin-left: 10px; margin-right: 10px; margin-bottom:0; ">
                            <div style=" display: table;  vertical-align: middle; margin-right: 10px;">
                            <div id="my-icon-select" style=" display: table-cell;z-index: 100"></div>
                            <input type="text" class="form-control" id="m_name" name="m_name" placeholder="name" style="width:20%  display: table-cell;margin-left: 10px;bottom: 14px;position: relative;" />
                            </div>
                            <textarea class="form-control" id="m_text" name="m_text" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="com_submit()" >Submit</button>
                    </div>
                </div>
            </div>
            <?php
            foreach ($comment as $val) {
            ?>
            <!-- Single Comment -->
            <div class="media mx-auto">
                <img class="d-flex mr-3 rounded-circle" src="<?=$val->cmt_img;?>" alt="" width="48" height="48">
                <div class="media-body">
                    <h5 class="mt-0"><?=$val->cmt_username;?></h5>
                    <?=nl2br($val->cmt_content);?>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<script>
    var iconSelect;
    window.onload = function(){
        iconSelect = new IconSelect("my-icon-select",
            {'selectedIconWidth':48,
                'selectedIconHeight':48,
                'selectedBoxPadding':1,
                'iconsWidth':45,
                'iconsHeight':45,
                'boxIconSpace':1,
                'vectoralIconNumber':4,
                'horizontalIconNumber':4
            });

        var icons = [];
        icons.push({'iconFilePath':'/saebom/img/face_img/1.png', 'iconValue':'1'});
        icons.push({'iconFilePath':'/saebom/img/face_img/2.png', 'iconValue':'2'});
        icons.push({'iconFilePath':'/saebom/img/face_img/3.png', 'iconValue':'3'});
        icons.push({'iconFilePath':'/saebom/img/face_img/4.png', 'iconValue':'4'});
        icons.push({'iconFilePath':'/saebom/img/face_img/5.png', 'iconValue':'5'});
        icons.push({'iconFilePath':'/saebom/img/face_img/6.png', 'iconValue':'6'});
        icons.push({'iconFilePath':'/saebom/img/face_img/7.png', 'iconValue':'7'});
        icons.push({'iconFilePath':'/saebom/img/face_img/8.png', 'iconValue':'8'});
        icons.push({'iconFilePath':'/saebom/img/face_img/9.png', 'iconValue':'9'});
        icons.push({'iconFilePath':'/saebom/img/face_img/10.png', 'iconValue':'10'});
        icons.push({'iconFilePath':'/saebom/img/face_img/11.png', 'iconValue':'11'});
        iconSelect.refresh(icons);
    };
    function com_submit(){
        var idx = '<?=$view[idx]?>';
        var m_name = document.getElementById('m_name').value;
        var m_text = document.getElementById('m_text').value;
        var img = $('.selected-icon').children().attr( 'src' );

        if(!m_name){
            alert('name!!!');
            return false;
        }
        if(!m_text){
            alert('write ur comment!!!');
            return false;
        }
        $.ajax({
            url: "/saebom/board/comment_write",
            type: "post",
            data: {
                idx: idx, m_name:m_name, m_text:m_text, img:img
            }, dataType: 'json',
            success: function (r) {
                if (r.code == 'success') {
                    window.location.reload();
                } else {
                    alert('댓글 등록 실패.. 다시 시도하세요!');
                }
            }
        });
    }
</script>