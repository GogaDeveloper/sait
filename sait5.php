
<meta charset="UTF-8" />
<table>
<form method=post>
<tr><td>Имя:</td><td><input type=text name=name></td></tr>
    <tr><td>Фамилия:</td><td><input type=text name=surname></td></tr>
<tr><td>Пароль:</td><td><input type=password name=pass></td></tr>
<tr><td>Пароль:</td><td><input type=password name=pass_again></td></tr>
<tr><td></td><td><input type=submit value='Зарегистрировать'></td></tr>
</form>
</table>
<?php

  $_POST['name'] = trim($_POST['name']);
  $_POST['surname'] = trim($_POST['surname']);
  $_POST['pass'] = trim($_POST['pass']);
  $_POST['pass_again'] = trim($_POST['pass_again']);

  if(empty($_POST['name'])) exit();
  if(empty($_POST['name'])) exit('Поле "Имя" не заполнено');
  if(empty($_POST['surname'])) exit();
  if(empty($_POST['surname'])) exit('Поле "Фамилия" не заполнено');
  if(empty($_POST['pass'])) exit('Одно из полей "Пароль" не заполнено');
  if(empty($_POST['pass_again'])) exit('Одно из полей "Пароль" не заполнено');
  if($_POST['pass'] != $_POST['pass_again']) exit('Пароли не совпадают');


  $filename = "users.txt";
  $arr = file($filename);
  foreach($arr as $line)
  {
      $data = explode("::",$line);
      $temp[] = $data[0];
  }

  if(in_array($_POST['name'], $temp))
  {
      exit("Данное имя уже зарегистрировано, пожалуйста, выберите другое");
  }

  $fd = fopen($filename, "a");
  if(!$fd) exit("Ошибка при открытии файла данных");
  $str = $_POST['name']."::".
      $_POST['pass']."\r\n";
  fwrite($fd,$str);
  fclose($fd);

  echo "<HTML><HEAD> 
         <META HTTP-EQUIV='Refresh' CONTENT='0; URL=$_SERVER[PHP_SELF]'> 
        </HEAD></HTML>";
?>