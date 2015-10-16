<?php
  if(count($argv) < 4)
  {// if the number of command line arguments is not enough
    echo "missing command line arguments\n";
    echo "Use the following\n";
    echo "php filename.php task_number input.txt output.txt\n";
    exit(1);
  }

  $file_stream = fopen($argv[2],'r'); // opening the input file
  $file_write = fopen($argv[3],'w'); // file stream to write out the output file
  if(!$file_stream)
  { // check if the input file can be opened
    echo ("Sorry could not open the file");
    exit(1);
  }

  if($argv[1] == 2) // setting up the map for task 2
  {
    $map = array('A' => 'Q', 'B' => 'R', 'C' => 'S','D' => 'T','E' => 'U', 'F' => 'V', 'G' => 'W', 'H' => 'X','I' => 'Y','J' => 'Z', 'K' => 'A', 'L' => 'B','M' => 'C', 'N' => 'D', 'O' => 'E', 'P' => 'F',
		'Q' => 'G', 'R' => 'H','S' => 'I', 'T' => 'J', 'U' => 'K','V' => 'L','W' => 'M', 'X' => 'N','Y' => 'O','Z' => 'P',
    'a' => 'q', 'b' => 'r', 'c' => 's','d' => 't','e' => 'u', 'f' => 'v','g' => 'w', 'h' => 'x',
		'i' => 'y','j' => 'z', 'k' => 'a', 'l' => 'b','m' => 'c', 'n' => 'd', 'o' => 'e','p' => 'f','q' => 'g','r' => 'h',
    's' => 'i', 't' => 'j', 'u' => 'k','v' => 'l','w' => 'm', 'x' => 'n', 'y' => 'o' , 'z' => 'p' );
  }
  while(false !== ($input_character = fgetc($file_stream)))
  {
    if($argv[1] == 1)
    {
      $encoded_character = encryptCharacter($input_character);
      fwrite($file_write, $encoded_character);
    }
    elseif ($argv[1] == 2)
    {
        $mapped_character = mapCharacter($map,$input_character);
        fwrite($file_write, $mapped_character);
    }
    else {
      echo "Sorry wrong task\nUse task number as either 1 or 2";
      exit(1);
    }
  }


function mapCharacter($map,$input_character)
{
  if(array_key_exists($input_character,$map))
  {
    return $map[$input_character];
  }
  else {
    return $input_character;
  }
}
function encryptCharacter($input_character)
{ // function that takes in a character and decodes it
  $ascii_value = ord($input_character);
  if($ascii_value >= 65 && $ascii_value <= 122)
  { // all small and capital letters
    if($ascii_value >= 65 && $ascii_value <= 90)
    { // all uppercase letters
    $ascii_value += 13;
      if($ascii_value > 90)
      {// wrap around
        $ascii_value = $ascii_value - 90;
        $ascii_value += 65 - 1;
      }
    }
    elseif ($ascii_value >=97 && $ascii_value <= 122)
    {// all lowercase letters
      $ascii_value += 13;
      if($ascii_value > 122)
      { // wrap around
        $ascii_value = $ascii_value - 122;
        $ascii_value += 97 - 1;
      }
    }
    else
    { // any other character between 90-97
      return $input_character;
    }
    return chr($ascii_value);
  }
  elseif($ascii_value >= 48 && $ascii_value <= 57)
  { // all numbers
    $ascii_value += 5;
    if($ascii_value > 57)
    { // wrap around
      $ascii_value -= 57;
      $ascii_value += 48 - 1;
    }
    return chr($ascii_value);
  }
  else {
      return $input_character;
  }
}

?>
