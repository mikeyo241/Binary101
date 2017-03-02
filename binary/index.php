<!-- Cory Wilson
     
     index.php
     March 1, 2017
	 
-->
<html>
   <head>
       <!-- Jquery and JQuery UI Libraries -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
       <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   </head>

   <?php
   	session_start();
   	require('lib.php');
   ?>
   <script>
      $(document).ready(function(){
         $("#decimalInput").change(function() {
            $("#binaryOutput").val(Math.floor(Number($("#decimalInput").val())).toString(2));
         });
         $("#decimalInput").keyup(function() {
            $("#binaryOutput").val(Math.floor(Number($("#decimalInput").val())).toString(2));
         });
      });
   </script>

   <h1>Decimal to Binary</h1>
   <form>
      Enter an integer:<br>
      <input type="number" step="1" min="0" value="12" id="decimalInput" /><br>
      Binary Output:<br>
      <input type="text" id="binaryOutput" value="1100" readonly>
      
   </form> 

   <h1>Binary to Decimal</h1>

<script>
      $(document).ready(function(){
         var outputInt = 0;
         $(".binaryButton").click(function() {
            if($(this).val() == "0") {
               $(this).val("1");
               outputInt += Number($(this).attr('id'));
            }
            else {
               $(this).val("0");
               outputInt -= Number($(this).attr('id'));
            }
            $("#decimalOutput").val(outputInt);

         });
      });
   </script>


   <form>
      Flip the switches:<br>
      <input type="button" id="8" class="binaryButton" value="0" />
      <input type="button" id="4" class="binaryButton" value="0" />
      <input type="button" id="2" class="binaryButton" value="0" />
      <input type="button" id="1" class="binaryButton" value="0" /><br>
      Decimal Output:<br>
      <input type="text" id="decimalOutput" value="0" readonly>
      
   </form>

   <?php
   $chap3Questions = array("0"=>"0000", "1"=>"0001", "2"=>"0010",
       "3"=>"0011", "4"=>"0100", "5"=>"0101", "6"=>"0110", "7"=>"0111",
       "8"=>"1000", "9"=>"1001", "10"=>"1010", "11"=>"1011","12"=>"1100",
       "13"=>"1101", "14"=>"1110", "15"=>"1111");
   $questionNumbers = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12,
       13, 14, 15);
   shuffle($questionNumbers);
   ?>

   <h1>Chapter 3 Quiz</h1>
   <form>
       <p id="questionNumber">Question 1</p>
       <label for="question"><?php echo $questionNumbers[0]; ?></label><br>
       <input type="text" id="question" class="quizInput" /><br>
       <p id="success" hidden="true">You did it!</p>
   </form>
<p></p>

   <script>
       $(document).ready(function() {
           var questionsArray = <?php echo json_encode($chap3Questions); ?>;
           var questionNumbers = <?php echo json_encode($questionNumbers); ?>;
           var currentQuestion = 0;
           var quizzing = true;

           $(".quizInput").keyup(function () {
               if ($(this).val() == questionsArray[questionNumbers[currentQuestion]]) {
                   $(this).css('background-color', 'LightGreen');
                   currentQuestion++;
                   if (currentQuestion >= 16) {
                       $(this).attr("readonly", "true");
                       $("#success").show();
                       return;
                   }
                   $("label[for=question]").text(questionNumbers[currentQuestion]);
                   $("#question").val("");

                   $("#questionNumber").text("Question " + (currentQuestion + 1));

               }
               else if ($(this).val().length >= 4) {
                   $(this).css('background-color', 'LightCoral');
                   $(this).val("");
               }
               else
                   $(this).css('background-color', 'white');
           });
       });

   </script>

</html>