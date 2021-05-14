<?php

  $new_line = "\r\n"; // windows => linux "\n"

  $data = 'question,answer,dummy,dummy';
  $data .= $new_line;

  $array = [
    ["ランじゃないものは、どれですか?","2a1de4f0-5b3a-4d20-8f91-245f5aadf9d8","2a1de4f0-5b3a-4d20-8f91-245f5aadf9d8","2a1de4f0-5b3a-4d20-8f91-245f5aadf9d8"],
    ["ランは、どれですか?","2a1de4f0-5b3a-4d20-8f91-245f5aadf9d8","2a1de4f0-5b3a-4d20-8f91-245f5aadf9d8","2a1de4f0-5b3a-4d20-8f91-245f5aadf9d8"]
  ];

  foreach($array as $i) {
    $data .= $i[0].",".$i[1].",".$i[2].",".$i[3];
    $data .= $new_line;
  }
     
  $file = fopen('./data.csv', 'w');
  fputs($file, $data);
  fclose($file);

?>