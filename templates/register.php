<?php include('includes/header.php'); ?>

     <form action="register.php" method="post" enctype="multipart/form-data" role="form">
               <div class="form-group">
                    <label>Name*</label>
                   <input type="text" placeholder="Name" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email Address*</label>
                    <input type="email" placeholder="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label>Choose username*</label>
                    <input type="text" placeholder="username" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password*</label>
                    <input type="password" placeholder="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Confirm password*</label>
                    <input type="password" placeholder="password" name="password2" class="form-control">
                </div>
                <div class="form-group">
                    <label>Upload Avatar</label>
                    <input type="file" name="avatar">
                    <p class="help-block"></p>
                </div>
                <div class="form-group">
                    <label>About Me</label>
                    <textarea name="about" rows="6" cols="80" class="form-control" placeholder="Tell about yourself"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Register" name="register" class="btn btn-default">
                </div>


            </form>

  <?php include ('includes/footer.php'); ?>