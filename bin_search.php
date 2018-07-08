<?php
      if (strlen($argv[1]) && strlen($argv[2])) {
          $file_name = $argv[1];
          $key = $argv[2];
		    function bin_search($file_name, $key) {
		    	$fp = fopen($file_name, 'r');
		    	$arr_file = array();
		    	if ($fp) {
		    	    $i = 0;
		            while(!feof($fp)){
                         $line = fgets($fp);
                         $temp = explode("\t", $line);
                         $arr_file[$i] = [$temp[0], $temp[1]];
                         $i++;
                  }
                  fclose($fp);
                  $count_mas = count($arr_file);
		    		if($count_mas < pow(2, 31)){
                      $start = 0;
                      $end = $count_mas - 1;
                      while(true){
                          $len = $end - $start ;
                          if($len > 2){
                              if($len % 2 != 0)   $len++;
                              $mid = (int) ($len/2 + $start);
                          }elseif($len >= 0){
                              $mid = $start;
                          }else{
                              return 'undef';
                          }
                          if(strcasecmp($arr_file[$mid][0],$key) == 0){
                              return substr($arr_file[$mid][1], 0, strlen($arr_file[$mid][1]) - 1);
                          }elseif(strcasecmp($arr_file[$mid][0], $key) > 0){
                              $end = $mid - 1;
                          }else{
                              $start = $mid + 1;
                          }
                      }
                  }else{
                      return 'undef';
                  }
		    	}
		    	else return "Ошибка при открытии файла";
		    }
          echo bin_search($file_name, $key);
      }
      else {
          echo "Введены не все значения для функции";
      }
?>