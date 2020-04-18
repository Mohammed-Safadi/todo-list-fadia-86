var ul_list = document.getElementById("list");  //store the list in array ul_list

var input1   = document.getElementById("txt1"); //store the input text inside the var input

var butn   =  document.getElementById("bt1");   //get the button of addtodo 

var i, z=0 ,txt, done=[], del=[], newtodo=[], listline=[];

//i for input, z for increment, done for done but, del for del but, newtodo for new todo added , listline for the list element added




butn.addEventListener("click",function(){
   
   i=input1.value;     //when write it out of the listner it's not work !!! I dont know why
    
   if(i){             // to be sure the vlue is not empty
       addToDo(i,z);
       input1.value="";
       z++;
    }
   else{
      alert("you have to inter a todo")
    }
});


function addToDo(newAdd,z) {  //function to add new todo to the list when button clicked
   txt ='<li class="liclass" id="mylist'+z+'"><p class="pclass" id="myp'+z+'">'+newAdd+'</p> '+
            ' <div class="flright"> <!--let this div float right-->'+
                  '<button type="button"  class="a1  hide" id="done'+z+'" >Mark as Done |</button>'+ 
                  '<button type="button"   class="a2  hide" id="del'+z+'" >  &nbspDelete </button>'+ 
            ' </div> '+
        '</li>';




   position="beforeend";

   ul_list.insertAdjacentHTML(position,txt);  //add new todo at the end

  newtodo[z]  = document.getElementById("myp"+z);
  done[z]     = document.getElementById("done"+z);
  del[z]      = document.getElementById("del"+z);
  listline[z] = document.getElementById("mylist"+z);



//when click on the button mark as done
done[z].onclick=function(){
   
   done[z].style.display="none";
   newtodo[z].style.color="green";

}

//when click on the button delete
del[z].onclick=function(){
     var conf= window.confirm("Are You Sure You want to delete?");
   if(conf){
      listline[z].style.display="none"; 
   }
}



}











