<?php include('includes/header.php'); ?>
         <ul id="topics">
       
          
        <?php if($topics): ?>
           
            <?php foreach($topics as $topic): ?>
             <?php if(isLoggedIn() and $topic->username == getUser()['username']): ?>
           
             <li class="topic">
                <div class="row">
                    <div class="col-md-2">
                         <img class="avatar pull_left" src="images/avatars/<?php echo $topic->avatar; ?>"/>
                     </div>
                     <div class="col-md-10">
                        <div class="topic-content pull-right">
                                                                
                            <h3><a href="topic.php?id=<?php echo $topic->id; ?>"><?php echo $topic->title;?></a></h3>
                            
                            <div class="topic-info">

                                    <a href="topics.php?category=<?php echo urlFormat($topic->category_id);?>"><?php echo $topic->name; ?> </a> 
                                    <a href="topics.php?user=<?php echo urlFormat($topic->user_id);?>"> 
                                    &nbsp <strong>user</strong>: <?php echo $topic->username; ?></a>
                                    &nbsp <strong>Posted on</strong>: <a href="" ><?php echo formatDate($topic->create_date); ?></a> 
                                    <br>
                                    <span class="badge pull-right"><?php echo replyCount($topic->id);?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>  
   
             <?php else: ?>
          <?php endif; ?>
     <?php endforeach; ?> 
          </ul>
    <?php else: ?>
           <p>No Topics To Display</p>
      
    <?php endif; ?>
                  <h3>Forum Statistics</h3>
                <ul>
                  <li>Total Number of Users: <?php echo $getTotalUsers; ?> </li>
                  <li>Total Number of Topics: <?php echo $getTotalTopics; ?></li>
                  <li>Total Number of Categories: <?php echo $getTotalCategories; ?></li>
                </ul>
  <?php include ('includes/footer.php'); ?>