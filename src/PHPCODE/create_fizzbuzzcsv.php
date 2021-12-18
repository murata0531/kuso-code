<?php
$fizzbuzz_csv = [];
for($i = 1;$i <= 100;$i++){
    if ($i % 3 == 0 && $i % 5 == 0) {
        $fizzbuzz_csv[$i] = ['message' => "FizzBuzz"];
    } else if ($i % 3 == 0) {
        $fizzbuzz_csv[$i] = ['message' => "Fizz"];
    } else if ($i % 5 == 0) {
        $fizzbuzz_csv[$i] = ['message' => "Buzz"];
    } else {
        $fizzbuzz_csv[$i] = ['message' => "normal"];
    }
}

$fp = fopen('fizzbuzz.csv', 'w');
 
foreach ($fizzbuzz_csv as $line) {
	fputcsv($fp, $line);
}
 
fclose($fp);
?>