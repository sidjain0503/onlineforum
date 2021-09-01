<!-- <li><a class="dropdown-item" href="#">acrion</a></li>  -->
<?php
include '_dbconnect.php';
 $sql ="SELECT * FROM `categories` ";
 $result = mysqli_query($conn,$sql);
 while ($row = mysqli_fetch_assoc($result)) {
    $cat_id= $row['category_id'];
     $cat= $row['category_name'];
echo '<li><a class="dropdown-item" href="./threadlist.php?catid='.$cat_id.'">'.$cat.'</a></li>
';
}

?>
<!--sql mein  LIMIT 3 add krdo limit ke liye  -->