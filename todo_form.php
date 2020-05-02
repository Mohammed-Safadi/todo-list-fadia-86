<?php  
      $db=new mysqli('localhost','root','','todo_list');  
      $done=0;
     

      if(!$db){
        die('Can not connect to database');
     }

    //insert into database
      if($_POST){ 
        $sql_i = 'INSERT INTO todo_table(todo,done) VALUES(?,?)';
        $statment = $db->prepare($sql_i);
        $statment->bind_param("si",$_POST['mytodo'],$done);

        if($statment->execute()){
           header('Location:todo_form.php?success=1&user_id'.$db->insert_id);
           exit;
        }
      }
   

      //delete record by id
      if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])){
        $sql_d='DELETE FROM todo_table WHERE id=?';
        $statment=$db->prepare($sql_d);
        $statment->bind_param("i",$_GET['id']);
        $statment->execute();
       

      }

   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="mystyle.css"/>
        <title>TO-do's-List</title>
        
    </head>
   
    <body>
       
      <main>

        <div class="todo-list"> <!-- container of todo's list-->
            <h1>My To-do's List </h1>
               <form class="addTask" method="post" action="todo_form.php" >
                  <input type="text"  id="txt1" placeholder="New Task" name="mytodo">
                  <button type="submit" id="bt1">Add to List</button> 
               </form>
        </div>
     

        <div id="show">
        <table>
        <thead>
          <tr>
            <th> ID          </th>
            <th> My Task     </th>
            <th> Done Or Not </th>
            <th> U/D         </th>
          </tr>
        </thead>

        <tbody>
        
        
        <?php  
        //read from database 
            $sql_s = "SELECT * FROM `todo_table` ORDER BY `id` DESC";
            $res = $db->query($sql_s);
            while(($row=$res->fetch_assoc())):
        ?>
          <tr>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['todo'] ?></td>
            <td ><?php if( ($row['done']) == 0){?> <span style="color:red">NOT</span> <?php } else {?><span style="color:green">DONE</span><?php }?> </td>
            <td>
               <a href="todo_update.php?action=update&id=<?php echo $row['id']?>" class="a1"> Update </a>
               <input type="hidden" name="id" value="<?php $row['id']?>">
               <a href="todo_form.php?action=delete&id=<?php echo $row['id']?>"  class="a2">Delete</a>
            </td>
          </tr>
          <?php endwhile ?> 
        </tbody>

      </table>
        </div>
      </main>
      
    
       


    </body>


</html>