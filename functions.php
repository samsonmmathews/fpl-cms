<?php

function set_message($text, $type='info'){
  $_SESSION['flash'] = ['text'=>$text,'type'=>$type];
}

function get_message(){
  if(!empty($_SESSION['flash'])){
    $m = $_SESSION['flash'];
    echo "<div class='alert alert-{$m['type']}'>{$m['text']}</div>";
    unset($_SESSION['flash']);
  }
}
?>