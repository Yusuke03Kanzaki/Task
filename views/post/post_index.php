  <!-- Page Header -->
  <header class="masthead" style="background-image: url('http://localhost/task/img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Let's post!</h1>
            <span class="subheading">Would you like to submit an article?</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p>Let's create your own article! Please fill out the form below.</p>
       <form action="<?php echo $base_url; ?>/post/post" method="post" name="body" id="contactForm" novalidate> <!-- ここからform部分 -->
          <div class="control-group">  <!--名前-->
            <div class="form-group floating-label-form-group controls">
              <label>Name</label>
              <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group"> <!--クラスの役割がわからない-->
            <div class="form-group floating-label-form-group controls">
              <label>Article Title</label>
              <input type="text" class="form-control" placeholder="Article Title" id="title" required data-validation-required-message="Please enter your Title.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Message</label>
              <textarea rows="5" class="form-control" placeholder="Message" id="message" ></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <button name='body' type="submit" class="btn btn-primary" id="sendMessageButton">SEND</button> 
        </form>
        <form>
      </div>
    </div>
  </div>
