<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="/template/css/all.css"/>
		<title>Авторизация</title>
	</head>
<body>
	<div class="container-fluid">
	
		<br/>
		
			<div class="row">
					<div class="col-sm"><strong>имя пользователя</strong>
	<a href="/tasks/?sort=name&pos=asc&page=<?=$_GET['page']?>"><i class="fas fa-chevron-up"></i></a>  <a href="/tasks/?sort=name&pos=desc&page=<?=$_GET['page']?>"><i class="fas fa-chevron-down"></i></a></div>
					<div class="col-sm"><strong>email</strong>
	<a href="/tasks/?sort=email&pos=asc&page=<?=$_GET['page']?>"><i class="fas fa-chevron-up"></i></a> <a href="/tasks/?sort=email&pos=desc&page=<?=$_GET['page']?>"><i class="fas fa-chevron-down"></i></a></div>
					<div class="col-sm"><strong>текст задачи</strong></div>
					<div class="col-sm"><strong>статус</strong>
	<a href="/tasks/?sort=status&pos=asc&page=<?=$_GET['page']?>"><i class="fas fa-chevron-up"></i></a> <a href="/tasks/?sort=status&pos=desc&page=<?=$_GET['page']?>"><i class="fas fa-chevron-down"></i></a></div>
			</div>
			
		<?php foreach ($result2 as $row){?>
			<div class="row">
					<div class="col-sm"><?=$row["name"]?></div>
					<div class="col-sm"><?=$row["email"]?></div>
					<div class="col-sm"><?=$row["text"]?></div>
					<div class="col-sm">
					<? if($row["status"]==1){ ?>выполнено<br/><? } ?>
					<? if($row["edit"]==1){ ?>отредактировано администратором<br/><? } ?>	
					</div>
			</div>
		<? } ?>
			<br/><br/>
			<nav aria-label="Page navigation example">
			  <ul class="pagination">
			  	<? for($i=1;$i<=$pages;$i++){ ?>
			  	<? if(isset($_GET['sort'])){ ?>
			  	<li class="page-item"><a class="page-link" href="/tasks/?page=<?=$i-1?>&sort=<?=$_GET['sort']?>&pos=<?=$_GET['pos']?>"><?=$i?></a></li>
			  	<? } else { ?>
			    <li class="page-item"><a class="page-link" href="/tasks/?page=<?=$i-1?>"><?=$i?></a></li>
			    <? } ?>
			    <? } ?>
			  </ul>
			</nav>
			
			<br/>
			
			<form method="post" id="tasks">
			  	<div class="form-group">
					<label for="exampleInputName">имя пользователя</label>
				    <input type="text" name="exampleInputName" class="form-control required" id="exampleInputName" aria-describedby="nameHelp">
				    <small id="nameHelp" class="form-text text-muted"></small>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail">email</label>
				    <input type="email" name="exampleInputEmail" class="form-control required" id="exampleInputEmail" aria-describedby="emailHelp">
				    <small id="emailHelp" class="form-text text-muted"></small>
				</div>
				<div class="form-group">
					<label for="exampleInputText">текст задачи</label>
				    <textarea name="exampleInputText" class="form-control required" id="exampleInputText" aria-describedby="textHelp"></textarea>
				    <small id="textHelp" class="form-text text-muted"></small>
				</div>
				<div class="alert alert-success" role="alert">Задача успешно добавлена!</div>
				<button type="submit" name="send" class="btn btn-primary">Добавить задачу</button>
			</form>
			<br/><br/>
			<a href="/auth/" class="btn btn-primary">Войти</a>
	<br/>
	
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
				let title = $(this).prev().html();
				$(this).next().html('Неправильно заполнено поле '+title);
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
	$('.alert-success').hide();
	$('#tasks').submit(function() {
		if (!falidator(this))
			return false;
		$.ajax({
			type:'POST',
			url:'/tasks/',
			data:$('#tasks').serialize(),
			success:function(z) {
				$('.alert-success').show();
			}

		});
		return false;
	});
	});
</script>	
</body>
</html>
