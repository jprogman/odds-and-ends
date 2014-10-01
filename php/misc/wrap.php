<?php

//Creates a new string with word wrapping by the given length of the column.
//The variable $string is not altered at all.

function wrap($string,$length){
	$newstr = ""; //to put the formatted strings
	$word = ""; //the current word

	$ws_pos_left = -1; //the whitespace location at the left of the current word
	$ws_pos_right = -1; //the whitespace location at the right of the current word

	$word_left = 0; //the starting location of the word
	$word_right = 0; //the ending location of the word
	
	$newline = 0; //the location on the string where the new line starts

	//word loop start
	while($ws_pos_right < strlen($string)){

		$ws_pos_left = $ws_pos_right;
		$ws_pos_right = strpos($string," ",$ws_pos_left+1);
		
		//Every words are seperated by blank spaces. If there are
		//none left, the total length of $string is used instead.
		if($ws_pos_right === FALSE){
			$ws_pos_right = strlen($string);
		}
	
		//Sets the beginning and ending points of the word.
		$word_left = $ws_pos_left+1;
		$word_right = $ws_pos_right-1;
		
		//Adds the whitespace to the beginning of the word.
		//(Except for the first word of $string)
		if($ws_pos_left >= 0){

			//If the current word does not fit in the current line,
			//the word is added on a new line.
			if($ws_pos_right-$newline > $length){
				$newstr .= "\n";
				$newline = $word_left;
			}else{
				$newstr .= " ";
			}
		}


		//Gets the string from $string
		$word = substr($string,$word_left,$word_right-$word_left+1);
	

		$word_index = 0;

		//word split start
		while($word_index*$length < strlen($word)){
			$word_pos = $word_index*$length;

			//gets the lowest length of string possible
			if(strlen($word)-$word_pos < $length)
				$sublen = strlen($word);
			else
				$sublen = $length;


			//adds the word (or portion of the word) to the returning string
			$newstr .= substr($word,$word_pos,$sublen);

			//Check if there are still more letters left in this word.
			//If so, the word will break up and a new line is created.
			if(($word_index+1)*$length < strlen($word)){
				$newstr .= "\n";
				$newline = ($word_index+1)*$length+$word_left;
			}

			$word_index ++;
		}
		//word split end

	}
	//word loop end

	return $newstr;
}

$str = "Hello there! Welcome! Enjoy.";

echo "<pre>".wrap($str,6)."</pre>";


?>

<!--
012345678
--------
hello*[0-4]
hello there,*
hello there, welcome!*have some fun today! abcdefghijklmnop.
-->




