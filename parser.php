<?php

if(isset($_POST['submit'])){

  $groupId = trim($_POST['groupId']);
  $offset = 0;

  do{
    $contents = file_get_contents("https://api.vk.com/method/groups.getMembers?group_id=$groupId&offset=$offset&version=5.73");
    // Преобразуем JSON в массив
    $members = json_decode($contents, true);
    $log = fopen('log.txt','a+');

    foreach($members['response']['users'] as $user_array) {
      //Запись в файл log.txt
      fwrite($log, "$user_array \n");
    }
    //Увеличить количество передаваемых id методом groups.getMembers
    $offset = $offset + 1000;
  }while($offset < $members['response']['count']);
  header('Location: success.html');
}
