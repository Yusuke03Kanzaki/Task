  <!-- Page Header -->
  <header class="masthead" style="background-image: url('http://localhost/task/img/sample-post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1><?php echo $this->escape($status['post_title']); ?></h1>
            <h2><?php echo $this->escape($status['post_subtitle']); ?></h2>
            <span class="meta">Posted by
              <a href="#"><?php echo $this->escape($status['user_name']); ?></a>
              on <?php echo $this->escape($status['created_at']); ?></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
</div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <?php foreach ($statuses as $status): ?>
              <?php echo $this->render('post/status', array('status' => $status)); ?>
        <?php endforeach; ?>
        <div class="post-preview">
          <a href="<?php echo $base_url; ?>/post/sample">
            <h2 class="post-title">
              Man must explore, and this is exploration at its greatest
            </h2>
            <h3 class="post-subtitle">
              Problems look mighty small from 150 miles up
            </h3>
          </a>
          <p class="post-meta">Posted by
            <a href="#">Start Bootstrap</a>
            on September 24, 2019</p>
        </div>
        <hr>
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts</a>
        </div>
      </div>
    </div>
  </div>