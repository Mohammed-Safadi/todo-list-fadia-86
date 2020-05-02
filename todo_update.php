<?php  
      $db=new mysqli('localhost','root','','todo_list');  

      if(!$db){
         die('Can not connect to database');
      }

      $todo = [
        'id'=>0,
        'todo'=>'',
        'done'=>0,
      ];
    
      $id = (isset($_GET['id']) && $_GET['id'] != 0  && $_GET['action'] == 'update'? $_GET['id']: 0 );//if is found i will take it if not it will be zero
     
      if($id){
        $sql='SELECT * FROM todo_table WHERE id=?';
        $statment = $db->prepare($sql);
        $statment->bind_param('i',$_GET['id']);
        $statment->execute();
        $res = $statment->get_result();
        $todo = $res->fetch_assoc();
      
       
      }
      if(isset($_POST['id']) && $_POST['id'] !=0 ){
       $sql_u = 'UPDATE todo_table SET
                  todo = ?,
                  done = ?,
                  WHERE id=?';
        $stat = $db->prepare($sql_u);
        $stat->bind_param('sii',$_POST['todo'],$_POST['done'],$_POST['id']);
        
        $stat->execute();
    
     
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
                 <input type="hidden" name="id" vlaue="<?php $todo['id']?>">
                  <label>Update Todo</label>	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	
                  <input type="text"   id="txt1"  name="mytodo" value="<?php echo $todo['todo']?>"></br></br>

                  <label>Update DONE/NOT</label>
                  <input type="number"  id="no1"  style="height:30px; width:40px" name="myno" value="<?php echo $todo['done']?>"></br></br>
                  
                  <button type="submit" id="bt1">UPDATE </button> 
               </form>
     
        </div>
  
      </main>
    
    </body>


</html>