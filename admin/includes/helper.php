<?php

//Delete function
function delete($table, $colName, $id){
    global $connection;
    $query = mysqli_query($connection, "DELETE FROM $table WHERE $colName = '$id'");
    if($query){
        return true;
    }else{
        return false;
    }
}

//approve or unapprove
function confirm($id){
    global $connection;
    $query = mysqli_query($connection, "SELECT status FROM comments WHERE id =$id");
    if(mysqli_num_rows($query)>0){
        $result = mysqli_fetch_array($query);
        $status = $result['status'];

        //chech the value of status
        if($status == 'Unapproved'){
            $sql = mysqli_query($connection, "UPDATE comments SET status ='Approved' WHERE id = '$id'");
        }
        else{
            $sql = mysqli_query($connection, "UPDATE comments SET status ='Unapproved' WHERE id = '$id'");
        }
        return true;
    }else{
        return false;
    }

}

//Redirect helper
function redirect($page = 'index.php'){
    header("location:".$page."");

}

//publish or draft
function modifyStatus($id){
    global $connection;
    $query = mysqli_query($connection, "SELECT post_status FROM posts WHERE post_id = $id");
    if(mysqli_num_rows($query)>0){
        $result = mysqli_fetch_array($query);
        $status = $result['post_status'];

        if($status == "draft"){
            $query = mysqli_query($connection, "UPDATE posts SET post_status = 'published' WHERE post_id = $id");
        }else{
            $query = mysqli_query($connection, "UPDATE posts SET post_status = 'draft' WHERE post_id = $id");
        }
        return true;
    }else{
        return false;
    }

}
