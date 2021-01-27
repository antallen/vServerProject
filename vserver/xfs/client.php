<?php

      $message=shell_exec("sudo ./test.sh 2>&1");
  
   /* 
      // File name and username to use
      $file_name= "test1.sh";
      $path = "./" . $file_name ;
      $user_name = "apache";

      // Set the user
      chown($path, $user_name);

      // Check the result
      $stat = stat($path);
      print_r(posix_getpwuid($stat['uid']));	
*/
      print_r($message);

?>
