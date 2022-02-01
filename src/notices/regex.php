<?php
require_once '../../vendor/autoload.php';
// [] - klasa znakow
// [abc] - Matches any one of the characters a, b, or c. // pasuje do dowolnego z : a,b,c
// [^abc] - Matches any one character other than a, b, or c.
// [0-9] - Matches a single digit between 0 and 9.
// [a-z] - Matches any one character from lowercase a to lowercase z.
// [A-Z] - Matches any one character from uppercase a to uppercase z.
// [a-Z] - Matches any one character from lowercase a to uppercase Z.
// [a-z0-9]- Matches a single character between a and z or between 0 and 9.

//$pattern = "/ca[kf]e/";
//$text = "He was eating cake in the cafe.";
////$text = "He was eating in the cafe.";
//$found = [];
//
//if(preg_match($pattern, $text, $found)){
//    echo "Match found!" . PHP_EOL;
//    var_export($found);
//} else{
//    echo "Match not found.";
//}
//
//$found = [];
//
//if(preg_match_all($pattern, $text, $found)){
//    echo "Match found!" . PHP_EOL;
//    var_export($found);
//} else{
//    echo "Match not found.";
//}
//
//echo PHP_EOL;

// klasy znaków predefiniowane
// .	Matches any single character except newline \n.
// \d	matches any digit character. Same as [0-9]
// \D	Matches any non-digit character. Same as [^0-9]
// \s	Matches any whitespace character (space, tab, newline or carriage return character). Same as [ \t\n\r]
// \S	Matches any non-whitespace character. Same as [^ \t\n\r]
// \w	Matches any word character (definned as a to z, A to Z,0 to 9, and the underscore). Same as [a-zA-Z_0-9]
// \W	Matches any non-word character. Same as [^a-zA-Z_0-9]

$wordText = 'dskjlsdfkfjd897987cvxvxshskl';
$nonWordCharacterPattern = '/\d/';
var_dump(preg_match($nonWordCharacterPattern, $wordText), true);

//echo PHP_EOL;

//$pattern = "/\s/";
//$replacement = "-";
//$text = "Earth revolves around\nthe\tSun";
//// Replace spaces, newlines and tabs
//echo preg_replace($pattern, $replacement, $text);
//echo "<br>";
//// Replace only spaces
//echo str_replace(" ", "-", $text);



// **** Repetition Quantifiers **** - Kwantyfikatory powtórzeń


// RegExp	What it Does
// p+	Matches one or more occurrences of the letter p.
// p*	Matches zero or more occurrences of the letter p.
// p?	Matches zero or one occurrences of the letter p.
// p{2}	Matches exactly two occurrences of the letter p.
// p{2,3}	Matches at least two occurrences of the letter p, but not more than three occurrences of the letter p.
// p{2,}	Matches two or more occurrences of the letter p.
// p{,3}	Matches at most three occurrences of the letter p



//$text = 'pp abcd ppp ooo, ppp dadlkjl kjhkjhvkj kk ooo msdkjsdsd oo nmnnb';
////$regex = '/p{3}|p{2}/';
//$regex = '/p{,3}/';
//$founded = [];
//var_dump(preg_match($regex, $text));
//preg_match_all($regex, $text, $founded);
//var_dump($founded);


// The regular expression in the following example will splits the string at comma, sequence of commas, whitespace
//$pattern = "/[\s,]+/"; // tutaj jeszcze bierze pod uwage przecinki
//$text = "My favourite colors are red, green and blue";
//$parts = preg_split($pattern, $text);
//
//// Loop through parts array and display substrings
//foreach($parts as $part){
//    echo $part . PHP_EOL;
//}



// *** Position Anchors - kotwice pozycyjne ***




// There are certain situations where you want to match at the beginning or end of a line, word, or string.
// To do this you can use anchors. Two common anchors are caret (^) which represent the start of the string,
// and the dollar ($) sign which represent the end of the string.

// The regular expression in the following example will display only those names from the names array which start with the letter "J" using the PHP preg_grep()

//$pattern = "/^J/";
//$names = ["Jhon Carter", "Clark Kent", "John Rambo"];
//$matches = preg_grep($pattern, $names);
//
//// Loop through matches array and display matched names
//foreach($matches as $match){
//    echo $match . PHP_EOL;
//}

//$testEmail = 'piotr.kowerzanow@gmail.com';
//$onlyOneAtInWord = "/(^[^@]*@[^@]*$)/";
//$emailValidator = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix';
//$founded = [];
//$match = preg_match($emailValidator, $testEmail, $founded);
//var_dump(\PkowerzMacwro\GitSandbox\Tools\EmailValidator::isValid($testEmail));


// Pattern modifiers  ****


// Modifier	What it Does
// i	Makes the match case-insensitive manner.
// m	Changes the behavior of ^ and $ to match against a newline boundary (i.e. start or end of each line within a multiline string), instead of a string boundary.
// g	Perform a global match i.e. finds all occurrences.
// o	Evaluates the expression only once.
// s	Changes the behavior of . (dot) to match all characters, including newlines.
// x	Allows you to use whitespace and comments within a regular expression for clarity.

//$pattern = "/^color/im";
//$text = "Color red is more visible than \ncolor blue in daylight.";
//$matches = preg_match_all($pattern, $text, $array);
//echo $matches . " matches were found.";

// Word boundaries ****

//A word boundary character ( \b) helps you search for the words that begins and/or ends with a pattern.

//$pattern = '/\bcar\w*/';
//$replacement = '<b>$0</b>';
//$text = 'Words begining with car: cart, carrot, cartoon. Words ending with car: scar, oscar, supercar.';
//echo preg_replace($pattern, $replacement, $text);
