<?php 
    session_start();

    if(isset($_SESSION["username"])){
        echo '<script>alert("'.$_SESSION["username"].'會員您好");</script>';
    }else{
        echo '<script>alert("請先登入會員");location.href="20190218-member-login.php";</script>';
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    	.mt10{
    		margin-top: 10px;
    	}
    	.mr5{
    		margin-right: 5px;
    	}
    </style>


  </head>
  <body>
  	<div class="container">
  		<div class="row">
  			<h1 class="text-center">會員列表</h1>
  			<div class="col-sm-8 col-sm-offset-2">
				    <table class="table mt10">
				    	<thead>
				    		<tr>
				    			<th>ID</th>
				    			<th>Username</th>
				    			<th>Password</th>
				    			<th>Bday</th>
				    			<th>Sex</th>
				    			<th>Create_time</th>
				    			<th>#</th>
				    		</tr>
				    	</thead>
				    	<tbody id="member_list">
				    		
				    	</tbody>
				    </table>  				
  			</div>
  		</div>
  	</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
    	$(function(){
    		$.ajax({
    			type: "GET",
    			url: "http://192.168.60.150/mobileWEB/memberAPI/20190218-member-read-api.php",
    			dataType: "json",
    			success: showMember,
    			error:function(){
						alert("會員列表api回傳失敗");
					}
    		});
    	});

    	function showMember(data){
    		for(i=0; i<data.length; i++){
    			strHTML = "";
    			strHTML = '<tr><td>'+data[i].ID+'</td><td>'+data[i].Username+'</td><td>'+data[i].Password+'</td><td>'+data[i].Bday+'</td><td>'+data[i].Sex+'</td><td>'+data[i].Create_time+'</td><td><a href="20190218-member-update.php?ID='+data[i].ID+'" class="btn btn-sm btn-primary mr5">更新</a><a data-id="'+data[i].ID+'" href="#" class="btn btn-sm btn-danger" onclick="del_item(this)">刪除</a></td></tr>';
    			$("#member_list").append(strHTML);
    		}    		
    	}
    	
      function del_item(myevent){
        // console.log($(myevent).data("id"));
        if(confirm("確定刪除會員"+$(myevent).data("id")+"??")){
          $.ajax({
            type: "POST",
            url: "memberAPI/20190221-member-delete-api.php",
            data: {ID: $(myevent).data("id")},
            success:show,
            error: function(){
              alert("刪除會員API失敗");
            }
          });
        }else{

        }
      }

      function show(data){
        if(data){
          location.href="20190218-member-read.php";
        }else{
          alert("刪除會員失敗");
        }
      }
    </script>    
  </body>
</html>

