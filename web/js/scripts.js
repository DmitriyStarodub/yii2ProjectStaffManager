function OnClickRemoveProject(id){
      $.ajax({
        url: '/project/remove',
        data: {id: id},
        type: 'GET',
        success: function(res){
            console.log(res);
           window.location.reload();
          },
        error: function(){
            alert('Error!');
        }
    });
    
}

function OnClickRemoveStaff(id){
      $.ajax({
        url: '/staff/remove',
        data: {id: id},
        type: 'GET',
        success: function(res){
            console.log(res);
           window.location.reload();
          },
        error: function(){
            alert('Error!');
        }
    });
    
}





    
    
    
    




