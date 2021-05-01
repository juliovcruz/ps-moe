<?php

  function connectDb() {
    $conn = new mysqli("db", "root", "pass", "moet");

    if($conn->connect_error) {
      echo "<br>";
      die("No connected: " . $conn->connect_error);
    }

    return $conn;
  }

  function checkIfPasswordIsCorrect($senha, $senhaEncriptada) {
    if (md5($senha) == $senhaEncriptada) {
      return true;
    }

    return false;
  }

?>