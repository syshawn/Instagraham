$(document).ready(function(){

var idcreator = $("#hidden_idcreator").val();

get_data();
function get_data() {
    $.ajax({
        url: "/Coursework/includes/account_setting.php",
        type: 'post',
        dataType: 'json',
        data: {
            'idcreator': idcreator,
          'acc_detail': 'acc_detail',
        },
        success: function(detail){
              var name = detail[0].name;
              var website = detail[0].website;
              var imageurl = detail[0].imageurl;
              var bio = detail[0].bio;
              var email = detail[0].email;
              var phoneNo = detail[0].phoneNo;
              var created_at = detail[0].created_at;
              var profilePhoto = detail[0].profilePhoto;
              var gender = detail[0].gender;
              var username = detail[0].username;

              if(profilePhoto== null){
                document.getElementById("blah").src = "/Coursework/icon/person.svg";
              }else{
                document.getElementById("blah").src = "/Coursework/uploads/" + profilePhoto;
              }
              
              $("#name").val(name);
              $("#website").val(website);
              $("#bio").val(bio);
              $("#email").val(email);
              $("#phoneNo").val(phoneNo);
              $("#profilePhoto").val(profilePhoto);
              $("#gender").val(gender);
              $("#username").val(username);
              $("#show_username").text(username);
        }
      });
  }

  //ajax submit change password form
$( ".changepw" ).on( "submit", function(e) {
 
    var dataString = $(this).serialize();
     
     console.log(dataString); 
     var old_pw = $("#oldPassword").val();
     var idcreator = $("#hidden_idcreator").val();
     
     //ajax validate old password
     $.ajax({
      url: "/Coursework/includes/account_setting.php",
      type: 'post',
      dataType: 'json',
      data: {
          'validate_pw': 'validate_pw',
          'idcreator': idcreator,
          'old_pw': old_pw,
      },
      success: function(response){
        
        if(response==true){
          actionChangePw();
          
        }else if(response==false){
          sweetalert('error', 'Oops...', 'Password Error!', 2000 ,true);
          $("#newPassword").val('');
          $("#oldPassword").val('');
          $("#confirmnewPassword").val('');
        }

      }
    });

    e.preventDefault();
  });

  //changePw
  function actionChangePw(){
    var new_pw = $("#newPassword").val();
     var idcreator = $("#hidden_idcreator").val();
     console.log(new_pw);
    $.ajax({
      url: "/Coursework/includes/account_setting.php",
      type: 'post',
      dataType: 'json',
      data: {
          'change_password': 'change_password',
          'idcreator': idcreator,
          'new_pw': new_pw,
      },
      success: function(response){
        
        if(response==true){
          sweetalert('success','Password changed successfully','Yeahhhh!',2000,true);
          $("#newPassword").val('');
          $("#oldPassword").val('');
          $("#confirmnewPassword").val('');
        }else if(response==false){
          sweetalert('error', 'Oops...', 'Something went wrong!', 2000 ,true);
          $("#newPassword").val('');
          $("#oldPassword").val('');
          $("#confirmnewPassword").val('');
        }else{
          console.log(response);
        }

      }
    });
  }

// delete account
  $( ".deletebtn" ).click(function() {

    var idcreator = $("#hidden_idcreator").val();

        $.ajax({
            url: "/Coursework/includes/account_setting.php",
            type: 'post',
            dataType: 'json',
            data: {
                'delete_account' : 'delete_account',
                'idcreator': idcreator,
            },
            success: function(response){
              
              if(response==true){
                sweetdeletealert('success','Account deleted successfully','Thanks! Hope to see you again!',2000,true);
                
              }else{
                sweetalert('error', 'Oops...', 'Something went wrong!', 2000 ,true);
              }

            }

          });


    
  });
  
    // ajax submit upload profile form
    $( ".profileform" ).on( "submit", function(e) {
      var fd  = new FormData();

      var files = $('#changeProfile')[0].files;
      var idcreator = $("#hidden_idcreator").val();
      var name = $("#name").val();
      var website = $("#website").val();
      var bio = $("#bio").val();
      var email = $("#email").val();
      var phoneNo = $("#phoneNo").val();
      var profilePhoto = $("#profilePhoto").val();
      var gender = $("#gender").val();
      if(files.length > 0 ){
      fd.append('file',files[0]);
    }
    fd.append('idcreator',idcreator);
    fd.append('name',name);
    fd.append('website',website);
    fd.append('bio',bio);
    fd.append('email',email);
    fd.append('phoneNo',phoneNo);
    fd.append('profilePhoto',profilePhoto);
    fd.append('gender',gender);

       $.ajax({
        url: "/Coursework/includes/profile_upload.php",
        type: 'post',
        dataType: 'json',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
          
          if(response==true){
            sweetalert('success','Profile changed successfully','Yeahhhh!',2000,true);
            get_data();
          }else if(response==false){
            sweetalert('error', 'Oops...', 'something error!', 2000 ,true);
          }else if(response=='withoutimage'){
            sweetalert('success', 'Profile changed successfully', 'But without Image', 2000 ,true);
          }else{
            console.log(response);
          }
  
        }
      });
    

      e.preventDefault();
    });

  // delete alert
  function sweetdeletealert(geticon,gettitle,gettext,time,progressBar){
    Swal.fire({
        icon: geticon,
        title: gettitle,
        text: gettext,
        showConfirmButton: false,
        timer: time,
        timerProgressBar: progressBar,
      }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
          window.location.replace("/Coursework/logout.php");
        }
      });
  };

  // sweet alert
  function sweetalert(geticon,gettitle,gettext,time,progressBar){
    Swal.fire({
        icon: geticon,
        title: gettitle,
        text: gettext,
        showConfirmButton: false,
        timer: time,
        timerProgressBar: progressBar,
      })
  }
  


});