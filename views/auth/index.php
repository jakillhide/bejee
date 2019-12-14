<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<title>Авторизация</title>
	</head>
<body>
	<div class="container-fluid">
	<? if(isset($_SESSION['auth'])){ ?>
	
		<br/>
		
		<form method="post"><button type="submit" name="exit" class="btn btn-primary">Выйти</button></form>
					
		<br/><br/>
		
		<div class="row">
					<div class="col-sm"><strong>имя пользователя</strong></div>
					<div class="col-sm"><strong>email</strong></div>
					<div class="col-sm"><strong>текст задачи</strong></div>
					<div class="col-sm"><strong>статус</strong></div>
		</div>
			
		<?php foreach ($result2 as $row){?>
			<div class="row">
					<div class="col-sm"><?=$row["name"]?></div>
					<div class="col-sm"><?=$row["email"]?></div>
					<div class="col-sm">
						<form method="post" class="tasks">
						<input type="hidden" value="<?=$row["id"]?>" name="idz" />
							<div class="form-group">
						<textarea name="exampleInputText" class="form-control required" id="exampleInputText" aria-describedby="textHelp"><?=$row["text"]?></textarea>
							    <small id="textHelp" class="form-text text-muted"></small>
							</div>
							<div class="alert alert-success" role="alert"></div>
							<button type="submit" name="send" class="btn btn-primary">Сохранить</button>
						</form><br/>
					</div>
					<div class="col-sm status" data-id="<?=$row["id"]?>">
					<input type="checkbox" class="done" <? if($row["status"]==1){ ?>checked="checked"<? } ?> /> выполнено<br/>
					</div>
			</div>
		<? } ?>
			<br/><br/>
			<nav aria-label="Page navigation example">
			  <ul class="pagination">
			  	<? for($i=1;$i<=$pages;$i++){ ?>
			    <li class="page-item"><a class="page-link" href="/auth/?page=<?=$i-1?>"><?=$i?></a></li>
			    <? } ?>
			  </ul>
			</nav>
			<br/><br/>
	
	<? }else{ ?>
		
		<?=$error?>
			
		<form method="post">
			<div class="form-group">
				<label for="exampleInputLogin">логин</label>
				<input type="text" name="exampleInputLogin" class="form-control" id="exampleInputLogin" aria-describedby="loginHelp">
				<small id="loginHelp" class="form-text text-muted"></small>
			</div>
			<div class="form-group">
				<label for="exampleInputPass">пароль</label>
				<input type="password" name="exampleInputPass" class="form-control" id="exampleInputPass" aria-describedby="passHelp">
				<small id="passHelp" class="form-text text-muted"></small>
			</div>
			<button type="submit" name="enter" class="btn btn-primary">Войти</button>
		</form>
	
	<? } ?>
	
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <script type="text/javascript">
 function falidator(item)
	{
		check = true;
		$(item).find('.required').each(function() {
			if ($(this).hasClass('required') && $(this).val() == '') {
				check = false;
				$(this).css('border', '1px red solid' );
				$(this).next().addClass('alert alert-danger');
				$(this).next().html('Неправильно заполнено поле');
			} else {
				$(this).css('border', '1px #000 solid');
				$(this).next().removeClass('alert alert-danger');
				$(this).next().html('');
			}
		});
		if (check) {
			return true;
		} else {
			return false;
		}
	}   
    
    
$(document).ready(function(){
	$('.status').change(function(){
		
		var aa = $(this).find(':checked').val();
		var bb = $(this).attr('data-id');
		
		if(aa == "on"){
			
			$.ajax({
				type:'POST',
				url:"/auth/",
				data:{done:1, zid:bb},
				
				success:function(a){
				
					console.log(a);
				}
			})
			
		}else{
			
			$.ajax({
				type:'POST',
				url:"/auth/",
				data:{done:0, zid:bb},
				
				success:function(a){
				
					console.log(a);
				}
			})
		}
		
	})


	$('.alert-success').hide();
	$('.tasks').submit(function() {
		if (!falidator(this))
			return false;
		$.ajax({
			type:'POST',
			url:'/auth/',
			data:$(this).serialize(),
			success:function(z) {
				console.log(z);
				window.location.assign("/auth/");
			}

		});
		return false;
	});
	});
</script>
</body>
</html>
