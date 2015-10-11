<?php

  if(count($argv) < 4)
  {
    echo "missing command line arguments\n";
    echo "Use the following\n";
    echo "php filename.php task_number input.txt output.txt\n";
    exit(1);
  }
  // opening the input file
  $file_stream = fopen("input.txt",'r');
  if(!$file_stream)
  {
    echo ("Sorry could not open the file");
    exit(1);
  }
  while($input_character = fgetc($file_stream))
  {
    $decoded_character = decryptCharacter($input_character);
    echo $decoded_character;
  }

function decryptCharacter($input_character)
{
  $ascii_value = ord($input_character);
  if($ascii_value >= 65 && $ascii_value <= 122)
  {
    if($ascii_value >= 65 && $ascii_value <= 90)
    {
    $ascii_value += 13;
      if($ascii_value > 90)
      {
        $ascii_value = $ascii_value - 90;
        $ascii_value += 65 + $ascii_value - 1;
      }
    }
    elseif ($ascii_value >=97 && $ascii_value <= 122) {
      $ascii_value += 13;
      if($ascii_value > 122)
      {
        $ascii_value = $ascii_value - 122;
        $ascii_value += 97 + $ascii_value - 1;
      }
    }
    else {
      return $input_character;
    }
    return chr($ascii_value);
  }
  else {
      return $input_character;
  }
}

?>
