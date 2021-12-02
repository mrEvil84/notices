<?php
        //Enter your code here, enjoy!
        function getData() {
            return [1,2,3,4,5];
        }


//$secElement = getData()[1];

//var_dump($secElement);
list(,,$thirdElement) = getData();

var_dump($thirdElement);

//$info = array('coffee', 'brown', 'caffeine');
// Listing all the variables
//list($drink, $color, $power) = $info;
