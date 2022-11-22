<?php
  function cryptmdp( $password )
  {
    $hashage_password = crypt($password, '$5$HasHpWdHOpitALlr$');
    return $hashage_password;
  }

  echo cryptmdp("gabin");
?>