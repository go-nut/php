<?php

/*
 * Simple program to implement some sorting algorithms
 * Nothing fancy, just something to make to get used to php
 */

function generateArray($size) {
  while(count($array) < $size) {
    $array[] = mt_rand();
  }
  return $array;
}

function bubbleSort(&$array) {
  for($i=count($array); $i > 0; $i--) {
    for($j=1; $j <= $i; $j++) {
      if($array[$j-1] > $array[$j]) { // swap
        $buff = $array[$j];
        $array[$j] = $array[$j-1];
        $array[$j-1] = $buff;
      }
    }
  }
  return $array;
}

function insertionSort(&$array) {
  for($i=1; $i < count($array); $i++) {
    for($j=$i; ($j > 0 && $array[$j] < $array[$j-1]); $j--) {
        $buff = $array[$j];
        $array[$j] = $array[$j-1];
        $array[$j-1] = $buff;
    }
  }
  return $array;
}

// Used for mergeSort
function merge(&$a, $left, $right, $end) {
  $i0 = $left;
  $i1 = $right;
  for($j = $left; $j < $end; $j++) {
    if($i0 < $right && ($i1 >= $end || $a[$i0] <= $a[$i1])) {
      $buff[] = $a[$i0];
      $i0++;
    } else {
      $buff[] = $a[$i1];
      $i1++;
    }
  }
  foreach($buff as $item) {
    $a[$left] = $item;
    $left++;
  }

}

function mergeSort(&$array) {
  $size = count($array);
  for($i = 1; $i < $size; $i *= 2) {
    for($j = 0; $j < $size; $j += ($i << 2)) {
      merge($array, $j, min($j + $i, $size), min($j + ($i << 2), $size));
    }
  }
}

// Used by quickSort
function partition(&$a, $left, $right, $pivot) {
  $pivotV = $a[$pivot];
  // swap
  $buff = $a[$pivot];
  $a[$pivot] = $a[$right];
  $a[$right] = $buff;

  $index = $left;
  for($i = $left; $i < $right; $i++) {
    if($a[$i] < $pivotV) {
      $buff = $a[$index];
      $a[$index] = $a[$i];
      $a[$i] = $buff;
      $index++;
    }
  }
  $buff = $a[$index];
  $a[$index] = $a[$right];
  $a[$right] = $buff;
  return $index;
}

// Used by quickSort
function qsort(&$array, $left, $right) {
  if($left < $right) {
    $pivotI = partition($array, $left, $right, mt_rand($left, $right));
    qsort($array, $left, $pivotI - 1);
    qsort($array, $pivotI + 1, $right);
  }
}

function quickSort(&$array) {
  qsort($array, 0, count($array)-1);
}

function selectionSort(&$a) {
  $size = count($a);
  for($i = 0; $i < $size; $i++) {
    $min = $i;
    for($j = $i + 1; $j < $size; $j++) {
      if($a[$i] > $a[$j]) {
        if($a[$min] > $a[$j]) {
          $min = $j;
        }
      }
    }
    $buff = $a[$i];
    $a[$i] = $a[$min];
    $a[$min] = $buff;
  }
}


?>
