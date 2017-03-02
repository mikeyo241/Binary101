<!-- Cory Wilson
     
     index.php
     March 1, 2017
	 
-->
<html>
   <head>
      <script src="jquery-3.1.1.min.js"></script>
   </head>

   <?php
   	session_start();
   	require('lib.php');
   ?>
   <script>
      $(document).ready(function(){
         $("#convert").click(function() {
            $("#binaryOutput").val(Math.floor(Number($("#decimalInput").val())).toString(2));
         });
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
      <input type="number" step="1" min="0" value="12" id="decimalInput" />
      <input type="button" id="convert" value="Convert" /><br>
      Binary Output:<br>
      <input type="text" id="binaryOutput" value="1100" readonly="true">
      
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
      <input type="text" id="decimalOutput" value="0" readonly="true">
      
   </form> 

</html>