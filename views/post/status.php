<div class="status">
    <div class="status_content">
        <a href="<?php echo $base_url; ?>/post/<?php echo $this->escape($status['user_name']);
        ?>/status/<?php echo $this->escape($status['id']); ?>">
            <h2><?php echo $this->escape($status['post_title']); ?></h2>
            <h3><?php echo $this->escape($status['post_subtitle']); ?></h3>
    </div>
    <div>
        <a href="<?php echo $base_url; ?>/post/<?php echo $this->escape($status['user_name']);
        ?>/post/<?php echo $this->escape($status['id']); ?>">
        </a>
        <p class="post-meta">Posted by <?php echo $this->escape($status['user_name']); ?> on           <?php echo $this->escape($status['created_at']); ?>
        </p>
    </div>
</div>