<?php

// PHP Logic Test

$array = [15, 16, 1, 4, 5, 87];

/**
 * Question 1: Sort in descending order
 * Since PHP already provides sorting algorithm for integer,
 * we will use rsort() function
 */
rsort($array);

/**
 * Question 2: Sort in ascending order
 * To short in ascending order, we can use short()
 */
sort($array);

/**
 * Question 3: print with comma delimiter
 * To print using delimiter, use join or implode
 */
echo join(", ", $array);

/**
 * Question 4: Calculate all members and push to the array
 * Again, PHP provides sum function to sum all integer
 * in an array
 */
$sum = array_sum($array);
array_push($array, $sum);

/**
 * Ordering array with properties
 * Let's take a few samples in 
 * our query result
 */
$students = [
    [
        'student_id' => 48,
        'name' => 'Muhammad Arifin Ilham',
        'nim' => 17898,
        'birthday' => '2003-03-27'
    ],
    [
        'student_id' => 327,
        'name' => 'Dahyun',
        'nim' => 17898,
        'birthday' => '2003-03-27'
    ],
    [
        'student_id' => 21,
        'name' => 'Jihyoo',
        'nim' => 17898,
        'birthday' => '2003-03-27'
    ],
    [
        'student_id' => 49,
        'name' => 'Chaeyoung',
        'nim' => 17898,
        'birthday' => '2003-03-27'
    ],
    [
        'student_id' => 31,
        'name' => 'Sana',
        'nim' => 17898,
        'birthday' => '2003-03-27'
    ],
    [
        'student_id' => 321,
        'name' => 'null',
        'nim' => 17898,
        'birthday' => '2003-03-27'
    ],
];

/**
 * In this case, we cannot use sort() directly, but we will still use it later on
 * The algorithm must be
 * 
 * 1. Extract the student_id from each data and store into temporary array
 * 2. Sort the temporary array with sort()
 * 3. Using nested loop, remap the original data with sorted student_id
 */
$temp = [];
$result = [];

foreach($students as $student) {
    array_push($temp, $student['student_id']);
}

sort($temp);

foreach($temp as $student_id) {
    foreach($students as $student) {
        if($student['student_id'] == $student_id) {
            array_push($result, $student);
            break;
        }
    }
}

// Let's see the result!
echo "<br />" . json_encode($result);

// Thanks