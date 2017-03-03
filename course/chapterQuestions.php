<?php
    $chap3Questions = array("0"=>"0000", "1"=>"0001", "2"=>"0010",
        "3"=>"0011", "4"=>"0100", "5"=>"0101", "6"=>"0110", "7"=>"0111",
        "8"=>"1000", "9"=>"1001", "10"=>"1010", "11"=>"1011","12"=>"1100",
        "13"=>"1101", "14"=>"1110", "15"=>"1111");
    $questionNumbers = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12,
        13, 14, 15);
    shuffle($questionNumbers);
?>

<script>
    var questionsArray = <?php echo json_encode($chap3Questions); ?>;
    var questionNumbers = <?php echo json_encode($questionNumbers); ?>;
</script>
