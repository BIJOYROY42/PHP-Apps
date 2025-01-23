<?php 
// variable
$name = "Aurora";
$number = 2;
// case sensitive

$NAME = "Lily";
var_dump($name);

// Casting
$a = (string) 5;
var_dump($a);

// Constants
// define("HELLO", "123");
const HELLO = "456";
echo HELLO;

// concatenation operator
echo 3+4 ."hello";
////////////////////////////////////////////////
if($number == "2"){
    // echo "Good";
    echo "<h1>Good</h1>";
}else{
    // echo "Bad";
    echo "<h1>Bad</h1>";
}
// see more in tutorial
//////////////////////Array/////////////////////////
// Indexed Array

$fruits = ["Apple", "Banana", "Cherry"];

echo $fruits[0]; 

$fruits[] = "Date";

foreach ($fruits as $fruit) {
    echo $fruit . " ";
}

print_r($fruits);
// assocative arrays (similar with object in javascript)
$person = [
    "name"=>"Lily",
    "age"=> 20,
    "city"=>"Calgary"
];

echo $person['name'];

foreach ($person as $key => $value){
    echo $value;
    echo "<br>";
}

// Multidimensional arrays
$persons=[
    [
    "name"=>"Lily",
    "age"=> 20,
    "city"=>"Calgary"
    ],
    [
        "name"=>"Mary",
        "age"=> 25,
        "city"=>"Calgary"
    ],
    [
        "name"=>"Tom",
        "age"=> 10,
        "city"=>"Calgary"
    ]
];

foreach ($persons as $person){
    echo $person['name'];
    echo "<br>";
}
///////practice: filter array element
$ages = [25, 30, 35, 20, 40];
$filteredAges = [];

foreach ($ages as $age) {
    if ($age >= 30) {
        $filteredAges[] = $age;
    }
}
print_r($filteredAges);

?>