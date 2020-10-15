<div class="status">
    <div class="status_content">
        <h2>
            <?php echo $this->escape($status['body']); ?>
        </h2>
        <a href="<?php echo $base_url; ?>/user/<?php echo $this->escape($status['user_name']); ?>">
            <?php echo $this->escape($status['user_name']); ?>
        </a>
        <?php echo $this->escape($status['body']); ?>
    </div>
    <div>
        <a href="<?php echo $base_url; ?>/user/<?php echo $this->escape($status['user_name']);
        ?>/post/<?php echo $this->escape($status['id']); ?>">
            <?php echo $this->escape($status['created_at']); ?>
        </a>
    </div>
</div>