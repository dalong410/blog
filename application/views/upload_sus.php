<ul>
    <?phpforeach ($upload_data as $item => $value):?>
    <li><?php echo $item;?>: <?php echo $value;?></li>
    <?phpendforeach; ?>
</ul>

<p><?php echo anchor('upload', 'Upload Another File!'); ?></p>