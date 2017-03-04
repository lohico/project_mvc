<?php include('includes/header.php'); ?>
   <ul id="topics">
      <li id="main-topic" class="topic topic">
                    <div class="row">
                        <div class="col-md-2">
                          <div class="user-info">

                            <img class="avatar pull_left" src="images/avatars/<?php echo $topic->avatar; ?>"/>
                            <ul>
                              <li><strong><?php echo $topic->username; ?></strong></li>
                              <li><?php echo userPostCount($topic->user_id); ?>&nbspPosts</li>
                              <li><a href="topics.php?user=<?php echo $topic->name; ?>">View topics</a></li>
                              </ul>
                        </div>
                        </div>
                    
                        <div class="col-md-9">
                            <div class="topic-content pull-right">
                                <br/>
                               <?php echo $topic->body; ?>
                               <?php if(isLoggedIn() and $topic->username == getUser()['username']): ?>
                             <form role="form" method="post" action="topic.php?id=<?php echo $topic->id; ?>">
                              <div class="form-group">
                              <br/>
                              <br/>
                              <br/>
                              <br/>
                              <br/>
                              <br/>
                            <textarea id="body" name="body" rows="4" cols="30" class="form-control" placeholder="Edit Topic"></textarea>
                             <button name="edit_topic" type="submit" class="btn btn-default">Edit Topic</button> 
                            </div>
                            </form>
                           
                            <?php else: ?>

                            <?php endif; ?>  
                            </div>
                            
                        </div> 
                        <div class="col-md-1">
                            <div class="topic-content pull-right">
                            <?php echo $visits; ?>
                            </div>
                        </div>
                    </div>
       </li>
       
          <h3>   Replies: </h3>
            <?php foreach ($replies as $reply): ?>
              <?php if(isLoggedIn() and $reply->topic_id == $_GET['id']): ?>
           
              
                <li class="topic topic">
                    <div class="row">
                        <div class="col-md-2">
                          <div class="user-info">
                            <img class="avatar pull_left" src="images/avatars/<?php echo $reply->avatar; ?>"/>
                            <ul>
                              <li><strong><?php echo $reply->username; ?> Reply</strong></li>
                              <li><?php echo userPostCount($reply->user_id); ?>&nbspPosts</li>
                              <li><a href="topics.php?user=<?php echo $reply->user_id; ?>">View Topics</a></li>
                              </ul>
                        </div>
                        </div>
                        <div class="col-md-9">
                            <div class="topic-content pull-right">
                               <?php echo $reply->body; ?> 
                            </div>
                        </div>
                       <?php if(isLoggedIn() and $topic->username == getUser()['username'] and $reply->topic_id ==$_GET['id']): ?>
                        
                         <div class="col-md-1">
                            <div class="topic-content pull-right">
                              <form role="form" method="post" action="topic.php?id=<?php echo $topic->id; ?>">
                                 <button name="do_delete" type="submit" class="btn btn-default">Delete</button> 
                              </form>  
                            </div>
                        </div>
                     
                    </div>
                </li>
                 <?php else: ?>
                          
                          <?php endif; ?>

                  <?php else: ?>

               <?php endif; ?>
           <?php endforeach; ?>
                  </ul>

                 
                  <!-- Pana aici avem ul -->
                  <h3>Reply To Topic</h3>
                   <?php if(isLoggedIn()) : ?>
                  <form role="form" method="post" action="topic.php?id=<?php echo $topic->id; ?>">
                     <div class="form-group">
                         <textarea id="reply" rows="10" cols="80" class="form-control" name="body"></textarea>
                         <script>CKEDITOR.replace('reply');</script>
                     </div> 
                     <button name="do_reply" type="submit" class="btn btn-default">Create a Reply</button> 
                     </form>  
                    <?php else: ?>
                      You need to login to Reply
                    <?php endif; ?> 
                 
<?php include ('includes/footer.php'); ?>