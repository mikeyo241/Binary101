<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<?php

require_once('gameLib.php');

function chooseChapter($chapterNumber){
    switch ($chapterNumber){
        case 1: {
            chap1();
            break;
        }
        case 2: {
            chap2();
            break;
        }
        case 3: {
            chap3();
            chap3Game();
            break;
        }
        case 4: {
            chap4();
            break;
        }
        case 5: {
            chap5();
            break;
        }
        case 6: {
            chap6();
            break;
        }
        case 7: {
            chap7();
            break;
        }
        case 8: {
            chap8();
            break;
        }
        case 9: {
            chap9();
            break;
        }
        case 10: {
            chap10();
            break;
        }
        default: {
            underConstruction();
            break;
        }
    }

}

function shadeActiveChapter(){
    $activeChapter = array (" "," "," "," "," "," "," "," "," ", " ");
    $i = 0;
    while($i <=10) {
        $activeChapter[$i] = " ";
        $i++;
    }
    $activeChapter[$_GET['xchwe'] - 1] = " active ";
    return $activeChapter;
}
function chap1() {
    echo <<< HTML
    
<div id="learningContent" >
<h1>Chap 1 - The History of Binary</h1>
<p>We all have seen binary before whether it be in movies, TV shows, or on the internet we all have an understanding
 that binary is the 1's and 0's that computers use to operate.
   To a computer binary is converted to electrical signals a high voltage for a
    1 and a low voltage for 0. Tiny transistors in the CPU are used to process 
    these signals to produce everything that you see on screen.  It has been theorized
     by Intel co-founder Gordon Moore that the number of transistors double every 2 years.
       Which although under very skeptical criticism has proved true for 42 years(1975-current year). 
</p>
<p><b>Moore's Law</b> -  is the observation that the number of transistors in a dense integrated circuit doubles approximately every two years.</p>
<p><b>Binary</b> -  a system of numerical notation to the base 2, in which each place of a number, expressed as 0 or 1, corresponds to a power of 2.</p>
<div class="container-fluid">
    <img src="assets/img/mooresLaw.png" alt="Microprocessor Transistor Counts 1971-2011 & Moore's Law" class="img-thumbnail">
</div>
<p>In 1679 a German polymath and philosopher  named Gottfried Wilhelm Leibniz documented the binary system.
  Binary is used in computers because it is the most practical way for a computer to process data.</p>

<h2>Why learn how binary works?</h2>

<p>If you are going into Programming the programs you will be writing in a high level language 
such as C++ will be compiled into assembly language which is binary.
<br>
If you are going into IT, binary is used to transmit data across networks 
and chips, It is used to stored data onto the hard drive.
<br>
Every letter you type is ASCii which is a standard that computers used to encode 
letters into binary you will learn more about ASCii in later Chapters.
</p>
</div>
HTML;

}
function chap2() {
    echo <<< HTML
    
    <div id="learningContent" >

            <h1>Chap 2 - Powers of 2</h1>
            <p>Before we get into powers of 2 (or the base 2 number system)
                we must first understand the number system we use: base 10. Take the number 125 for example:
        </p>
        <div class="container-fluid">
            <img src="assets/img/powersOf2.PNG" class="img-thumbnail">
        </div>
            <p>As you can see, the numbers we use in our day-to-day lives are constructed using powers of 10.
                Numbers in the 1's column are multiplied by 100 (1). Numbers in the 10's column are multiplied by 101 (10).
    Numbers in the 100's column are multiplied by 102 (100). This process is repeated to create larger numbers,
                with the sum of all columns representing the final number.
                <br>
                Binary (a base 2 number system) works in a similar fashion, but rather than multiply each number by powers of 10,
                you multiply by powers of two. Let's look at the number 13 represented in binary:
            </p>
            <div class="container-fluid">
                <img src="assets/img/powersOf2_2.PNG" class="img-thumbnail">
            </div>
            <p>Since we're only working with powers of 2, we only need two numbers to represent each column:
                a 0 or a 1. This on-off relationship (a binary relationship if you will) is the fundamental principle
                of computer technology. Columns are multiplied by 20, 21, 22, 23, and so on. These "powers of 2" values
                show up everywhere in computer technology, which is why it's paramount to understand them. Here's a graphical
                representation of each column's possible value in a full byte (8 bits, or 8 columns):
            </p>
            <div class="container-fluid">
                <img src="assets/img/powersOf2_3.PNG" class="img-thumbnail">
            </div>          

        </div>
HTML;

}

function chap3() {
    echo <<< HTML
    <div id="learningContent" >
            <h1>Chap 3 - Decimal to Binary Conversion</h1>

            <p> Converting Decimal or base 10 to Binary could be a very hard task especially using the wrong method.  One of the
                easiest ways of conversion is to using the powers of 2 discussed in the previous chapter.
                First we are going to convert 9<sub>10</sub> to binary.
            </p>
            <div class="container">          
                <img src="assets/img/decimalToBinary1.PNG" alt="Decimal to Binary illustration" class="img-thumbnail"> 
            </div>          
            <h2>Check out this video from Khan Academy on how to convert Decimal numbers to Binary</h2>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe  class="embed-responsive-item" src="https://www.youtube.com/embed/H4BstqvgBow?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
            </div>
            <h2>Input any number here to see the binary number it produces</h2>

            <!-- Game Created by Cory Wilson!!! -->
            <form class="form-inline">
                <div class="row">
                <label class="col-md-3" for="decimalInput">Enter an integer:</label>
                <input type="number" step="1" min="0" value="12" id="decimalInput" class="col-md-9 form-control" /></div>
                <br>
                <div class="row">
                <label class="col-md-3" for="decimalInput">Binary output:</label>
                <input type="text" id="binaryOutput" value="1100" readonly="true" class="col-md-9 form-control"></div>

            </form>
            <!--  End of Game Created by Cory Wilson  -->


            <p>Little number conversion game here!</p><br>
            <div class="container-fluid">
                <img src="assets/img/decimalToBinary2.PNG" class="img-thumbnail">
            </div>
            <h2>Check out Khan Academy's explanation on how to convert bigger numbers to Binary</h2>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe  class="embed-responsive-item" src="https://www.youtube.com/embed/bvcXEJbEzSs?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
            </div>
            <h2>Think you understand? Try it yourself!!!</h2>

            <form>
                <p id="questionNumber">Question 1</p>
                <label for="question"></label><br>
                <input type="text" id="question" class="quizInput" /><br>
                <p id="success" hidden>You did it!</p>
            </form>

        </div>
HTML;

}


function chap4(){
    echo <<< HTML
<div id="learningContent" >
    <h1>Chap 4 - Binary to Decimal Conversion</h1>
    <p>Binary or base 2 is like our regular base 10 numbering system but instead using 1-10 it uses 0-1.
     As an example, counting in binary looks like this:
     <br> 0000 = 0 <br> 0001 = 1 <br> 0010 = 2 <br> 0011 = 3 <br> 0100 = 4 <br> 0101 = 5 <br> 0110 = 6 <br>
    </p>
    <h2>How is this accomplished?</h2>
    <div class="container-fluid">
        <img src="assets/img/binToDecimalConversion.PNG" class="img-thumbnail">
    </div>
    <p>The binary number 0111 is converted to decimal or base 10 by taking the values of each bit and adding
     them together to get the decimal number the nibble represents. <br> This can be explained further by the video below
     from techquickie. 
    </p>
    <div class="container-fluid">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/LpuPe81bc2w?rel=0&amp;controls=0&amp;showinfo=0;end=235" frameborder="0" allowfullscreen></iframe>
    </div>
    <p>Flip the switches to see how turning on and off bits in the nibble changes the number.</p>
<!-- Flip the switches game by Cory Wilson!!!  -->
    <form>
      Flip the switches:<br>
      <input type="button" id="8" class="binaryButton" value="0" />
      <input type="button" id="4" class="binaryButton" value="0" />
      <input type="button" id="2" class="binaryButton" value="0" />
      <input type="button" id="1" class="binaryButton" value="0" /><br>
      Decimal Output:<br>
      <input type="text" id="decimalOutput" value="0" readonly="true">
      
   </form> 
<!-- End of Flip the Switches Game -->

    <br>
    <p>It is important to learn how to quickly calculate nibbles of binary quickly because nibbles will be used more in later chapters and later in your career.

<br>
<h2>Useful Definitions</h2>
<b>Bit</b> - a single digit of binary notation, represented either by 0 or by 1
<br>
<b>Nibble</b> - 4 bits  that can equal 0-16
<br>
<b>Byte</b> - 8 bits  0000 0000 can equal 0- 255
</p>

<h2>Try it yourself!</h2>
<h3 style="color: red;">QUIZ GAME HERE!!!</h3>
<p style="color: red">
This part should be 5 questions like What is 0010 in Decimal, 1111 in Decimal, 1001 in Decimal, 1100 in Decimal, 0011 in Decimal.
</p>
</div>
    
HTML;

}



function chap5(){
    echo <<< HTML
<div id="learningContent" >
	<h1>Chap 5 - Binary Math</h1>
	
	<h2>Position</h2>
	
	<p>In the Decimal System there are Ones, Tens, Hundreds, etc<br><nr>
		In Binary there are Ones, Twos, Fours, etc, like this:
	</p>
	<div class="container-fluid">
	    <img src="assets/img/binary-number.png" class="img-thumbnail" alt="binary-number">
	</div>
	
	<h2>Binary Addition</h2>
	
	<p>Now that we know binary numbers, we will learn how to add them. Binary addition 
	is much like your normal everyday addition (decimal addition), except that it carries 
	on a value of 2 instead of a value of 10.<br><br>
	For example: in decimal addition, if you add 8 + 2 you get ten, which you write as 10; 
	in the sum this gives a digit 0 and a carry of 1. Something similar happens in binary 
	addition when you add 1 and 1; the result is two (as always), but since two is written as 
	10 in binary, we get, after summing 1 + 1 in binary, a digit 0 and a carry of 1.<br><br>

	Therefore in binary:<br>
	0 + 0 = 0<br>
	0 + 1 = 1<br>
	1 + 0 = 1<br>
	1 + 1 = 10 (which is 0 carry 1)<br>
	</p>
	
	<p>Khan Academy Video(adding binary):  https://www.khanacademy.org/math/algebra-home/alg-intro-to-algebra/algebra-alternate-number-bases/v/binary-addition</p>
	
	<h2>Binary Subtraction</h2>
	
	<p>Binary subtraction is also similar to that of decimal subtraction with the difference 
	that when 1 is subtracted from 0, it is necessary to borrow 1 from the next higher order bit 
	and that bit is reduced by 1 (or 1 is added to the next bit of subtrahend) and the remainder is 1.<br><br>
	Thus the rules of binary subtraction are as follows:<br>
	</p>
	
	<table style="width:25%">
		<tr>
			<th>-</th>
			<th>0</th>
			<th>1</th>
		</tr>
		<tr>
			<td>0</td>
			<td>0</td>
			<td>1</td>
		</tr>
		<tr>
			<td>1</td>
			<td>1</td>
			<td>0</td>
		</tr>
	</table>
	
	<p>0 - 0 = 0<br>
	1 - 0 = 1<br>
	1 - 1 = 0<br>
	0 - 1 = 1 (with a borrow of 1)<br><br>
	For fractional numbers, the rules of subtraction are the same with the 
	binary point properly placed.
	</p>
	
	<h2>Binary Multiplication</h2>
	
	<p>Binary multiplication uses the same algorithm, but uses just three 
	order-independent facts: 0 x 0 = 0, 1 x 0 = 0, and 1 x 1 = 1 (these work 
	the same as in decimal). If you perform the multiplication phase with these 
	facts, you’ll notice two things: there are never any carries, and the partial 
	products will either be zeros or a shifted copy of the multiplicand.<br><br>

	Observing this, you’ll realize there’s no need for digit-by-digit 
	multiplication, which means there’s no need to consult a times table — 
	which means there’s no multiplication, period! Instead, you just write 
	down 0 when the current digit of the multiplier is 0, and you write down 
	the multiplicand when the current digit of the multiplier is 1.<br><br>
	</p>
	
	<div class="container-fluid">
	    <img src="assets/img/binary-multiplication.png" class="img-thumbnail" alt="binary multiplication">
	</div>
	
	<p>Each step is the placement of an entire partial product, unlike in decimal, 
	where each step is a single-digit multiplication (and possible addition of a carry).<br><br>

	In the addition phase, the partial products are added using binary addition, 
	and then the radix point is placed appropriately. This gives the answer 1001001.001.<br><br>
	</p>
	
	<p>Khan Academy Video (Binary Multiplication): https://www.khanacademy.org/math/algebra-home/alg-intro-to-algebra/algebra-alternate-number-bases/v/binary-multiplication</p>
	
	<h2>Binary Division</h2>
	
	<p>The method followed in binary division is also similar to that adopted 
	in decimal system. However, in the case of binary numbers, the operation is simpler 
	because the quotient can have either 1 or 0 depending upon the divisor.<br><br>
	The table for binary division is:
	</p>
	
	<table style="width:25%">
		<tr>
			<th>-</th>
			<th>1</th>
			<th>0</th>
		</tr>
		<tr>
			<td>1</td>
			<td>1</td>
			<td>Meaning less</td>
		</tr>
		<tr>
			<td>0</td>
			<td>0</td>
			<td>Meaning less</td>
		</tr>
	</table>
	<div class="container-fluid">
	    <img src="assets/img/binary-division.png" class="img-thumbnail" alt="binary division">
	</div>


</div>	




HTML;
}



function chap6() {
    echo <<< HTML
<div id="learningContent" >
    <h1>Chap 6 - Binary to Hexadecimal Conversion</h1>

	<h2>About Hexadecimal</h2>
	
	<p>Hexadecimal – also known as hex or base 16 – is a system we can use to 
		write and share numerical values.<br><br>
		Hex, like decimal, combines a set of digits to create large numbers. 
		It just so happens that hex uses a set of 16 unique digits. Hex uses the 
		standard 0-9, but it also incorporates six digits you wouldn’t usually 
		expect to see creating numbers: A, B, C, D, E, and F. <br><br>

		There are many (infinite!) other numeral systems out there. 
		Binary (base 2) is also popular in the engineering world, because 
		it’s the language of computers. The base 2, binary, system uses just 
		two digit values (0 and 1) to represent numbers.<br><br>

		Hex, along with decimal and binary, is one of the most commonly encountered 
		numeral systems in the world of electronics and programming. It’s important 
		to understand how hex works, because, in many cases, it makes more sense to 
		represent a number in base 16 than with binary or decimal.
	</p>
	
	<h2>Conversion</h2>
	
	<div class="container-fluid">
	    <img src="assets/img/bin2hex.png" class="img-thumbnail" alt="Bin2Hex" style ="width: 600px; height: 50px;">
	</div>  
	
	<h2>Subscripts</h2>
	<p>Decimal and hexadecimal have 10 digits in common, so they can create a lot of 
		similar-looking numbers. But 10 in hex is a wholly different number from that in 
		decimal. In fact hex 10 is equivalent to decimal 16. We need a way to explicitly 
		state whether a number we’re talking about is base 10 or base 16 (or base 8, or 
		base 2). Enter base subscripts:<br>
	</p>
	
	<div class="container-fluid">
	    <img src="assets/img/hexbase.png" class="img-thumbnail" alt="HexBase">
	</div>
	
	<h2>Converting To/From Decimal</h2>
	
	<h3>Converting from Decimal to Hex</h3>
	
	<p>Converting from decimal to hex involves a lot of division and remainders.<br><br>
		The steps to convert a number, let’s call it N, from decimal to hex look something like this:<br></p>
		
	<ol>
		<li>Divide N by 16. The remainder of that division is the first (least-significant/right-most)
			digit of your hex number. Take the quotient (the result of the division) to the next step.<br>
			Note: if the remainder is 10, 11, 12, 13, 14, or 15, then that becomes the hex digit 
			A, B, C, D, E, or F.
		</li>
		<li>Divide the quotient from the last step by 16 again. The remainder of this division is 
			the second digit of your hex value (second-from-the-right). Take the quotient from this 
			division to the next step.
		</li>
		<li>Divide the quotient from step 2 by 16 again. The remainder of this division is the third 
			digit of your hex conversion. Noticing a pattern?
		</li>
		<li>Keep dividing your quotient from the last step by 16, and storing the remainder until the 
			result of a division is 0. The remainder of that division is your hex value’s left-most, 
			most-significant digit.
		</li>
		
	</ol>
	
	<h3>Converting from Hex to Decimal</h3>
	
	<p>There’s an ugly equation that rules over hex-to-decimal conversion:<br></p>
	
	<div class="container-fluid">
	    <img src="assets/img/hex2bin.png" class="img-thumbnail" alt="Hex2Bin">
	</div>
	
	<p>There are a few important elements to this equation. Each of the h factors (hn, hn-1) is a 
	single digit of the hex value. If our hex value is F00D, for example, h0 is D, h1 and h2 are 
	0, and h3 is F.<br>

	Powers of 16 are a critical part of hexadecimal. More-signficant digits (those towards the 
	left side of the number) are multiplied by larger powers of 16. The least-significant digit, 
	h0, is multiplied by 160 (1). If a hex value is four digits long, the most-significant digit is 
	multiplied by 163, or 4096.<br>

	To convert a hexadecimal number to decimal, you need to plug in values for each of the h factors 
	in the equation above. Then multiply each digit by its respective power of 16, and add each product 
	up. Our step-by-step approach is:<br><br>
	</p>
	
	<ol>
		<li>Start with the right-most digit of your hex value. Multiply it by 160, that is: 
		multiply by 1. In other words, leave it be, but keep that value off to the side.<br>
		Remember to convert alphabetic hex values (A, B, C, D, E, and F) to their decimal 
		equivalent (10, 11, 12, 13, 14, and 15).
		</li>
		<li>Move one digit to the left. Multiply that digit by 161 (i.e. multipy by 16). 
		Remember that product, and keep it to the side.
		</li>
		<li>Move another digit left. Multiply that digit by 162 (256) and store that product.
		</li>
		<li>Continue multiplying each incremental digit of the hex value by increasing powers 
		of 16 (4096, 65536, 1048576, …), and remember each product.
		</li>
		<li>Once you’ve multiplied each digit of the hex value by the proper power of 16, add 
		them all up. That sum is the decimal equivalent of your hex value.
		</li>
	</ol>
</div>
HTML;

}


function chap7() {
    echo <<< HTML
<div id="learningContent" >
    <h1>Chap 7 - 2's Complement</h1>
	
	<h2>2's Complement Notation</h2>
	
	<p>Two's complement number representation is used for signed numbers on most 
	modern computers. This notation allows a computer to add and subtract numbers using the 
	same operations (thus we do not need to implement adders and subtractors). We can characterize 
	two's complement notation as:<br>
	</p>
	
	<ul>
		<li>A fixed number of bits are used to represent numbers</li>
		<li>The most significant bit is called the sign bit</li>
		<li>This same notation is used to represent both positive and negative numbers</li>
	</ul>
	
	<p>Positive numbers are represented normally.</p>
	<p>Negative numbers are represented using a 2's complement form. To obtain the 2's 
	complement of a number:<br>
	</p>
	<ol>
		<li>Complement the bits</li>
		<li>Add one to the result</li>
	</ol>
	
	<h2>Four-Bit Two's Complement Values</h2>
	
	<table style="width:50%">
		<tr>
			<th>Two's Complement</th>
			<th>Decimal Number</th>
		</tr>
		<tr>
			<td>0000</td>
			<td>0</td>
		</tr>
		<tr>
			<td>0001</td>
			<td>1</td>
		</tr>
		<tr>
			<td>0010</td>
			<td>2</td>
		</tr>
		<tr>
			<td>0011</td>
			<td>3</td>
		</tr>
		<tr>
			<td>0100</td>
			<td>4</td>
		</tr>
		<tr>
			<td>0101</td>
			<td>5</td>
		</tr>
		<tr>
			<td>0110</td>
			<td>6</td>
		</tr>
		<tr>
			<td>0111</td>
			<td>7</td>
		</tr>
		<tr>
			<td>1000</td>
			<td>-8</td>
		</tr>
		<tr>
			<td>1001</td>
			<td>-7</td>
		</tr>
		<tr>
			<td>1010</td>
			<td>-6</td>
		</tr>
		<tr>
			<td>1011</td>
			<td>-5</td>
		</tr>
		<tr>
			<td>1100</td>
			<td>-4</td>
		</tr>
		<tr>
			<td>1101</td>
			<td>-3</td>
		</tr>
		<tr>
			<td>1110</td>
			<td>-2</td>
		</tr>
		<tr>
			<td>1111</td>
			<td>-1</td>
		</tr>
	</table>
</div>
HTML;

}


function chap8() {
    echo <<< HTML
<div id="learningContent" >
    <h1>Chap 8 - Venn Diagrams</h1>
	
	<h2>Definition</h2>
	
	<p>Venn Diagram - a diagram representing mathematical or logical sets pictorially as 
	circles or closed curves within an enclosing rectangle (the universal set), common elements 
	of the sets being represented by the areas of overlap among the circles.<br>
	</p>
	
	<h2>Venn Diagram Sets</h2>
	
	<h3>Intersection of two sets: A &cap; B</h3>
	
	<div class="container-fluid">
	    <img src="assets/img/intersection.png" class="img-thumbnail" alt="intersection">
	</div>
	
	<p>The intersection of a venn diagram only contains the data that is shared between
	both of the sets.
	</p>
	
	<h3>Union of two sets: A &cup; B</h3>
	
	<div class="container-fluid">
	    <img src="assets/img/union.png" class="img-thumbnail" alt="union">
	</div>
	
	<p>The union of a venn diagram contains all of the data in either and both sets.
	</p>
	
	<h3>Symmetric Difference of two sets: A &#x25B3; B</h3>
	
	<div class="container-fluid">
	    <img src="assets/img/symmetric-difference.png" class="img-thumbnail" alt="symmetric-difference">
	</div>
	
	<p>The symmetric difference of a venn diagram contains only the data that one or
	the other set has but does not contain the data shared by the sets.
	
	<h3>Relative Complement of A(left) in B(right): A<sup>C</sup> &cup; B = B \ A</h3>
	
	<div class="container-fluid">
	<img src="assets/img/relative-complement.png" class="img-thumbnail" alt="relative-complement">
	</div>
	
	<p>The relative complement of a venn diagram contain only the data of one set that is 
	unique to only that set.
	</p>
	
	<h3>Absolute Complement of A in U: A<sup>C</sup> = U \ A</h3>
	
	<div class="container-fluid">
	<img src="assets/img/absolute-complement.png" class="img-thumbnail" alt="absolute-complement">
	</div>
	
	<p>The absolute complement of a venn diagram contains the data of one set that is unique to 
	only that set and all of the data that is not contained in any of the sets of data.
	</p>
</div>
HTML;

}


function chap9() {
    echo <<< HTML
    <div id="learningContent" >
    <h1>Chap 9 - Truth Tables</h1>
	
	<h2>Definition</h2>
	
	<p>A truth table is a mathematical table used in logic which sets out the functional 
	values of logical expressions on each of their functional arguments.In particular, truth 
	tables can be used to show whether a propositional expression is true for all legitimate 
	input values, that is, logically valid.<br>
	
	A truth table has one column for each input variable (for example, A and B), and one final column 
	showing all of the possible results of the logical operation that the table represents (for example, 
	A XOR B). Each row of the truth table contains one possible configuration of the input variables (for 
	instance, A=true B=false), and the result of the operation for those values.<br>
	</p>
	
	<h2>Unary Operation</h2>
	
	<p>There are 4 unary operations:</p>
	
	<ul>
		<li>Always true</li>
		<li>Never true, unary falsum</li>
		<li>Unary Identity</li>
		<li>Unary negation</li>
	</ul>
	
	<h3>Logical True</h3>
	
	<p>The output value is always true, regardless of the input value of p.</p>
	
	<table style="width:25%">

		<tr>
			<th>p</th>
			<th>T</th>
		</tr>
		<tr>
			<td>T</td>
			<td>T</td>
		</tr>
		<tr>
			<td>F</td>
			<td>T</td>
		</tr>
	</table>
	
	<h3>Logical False</h3>
	
	<p>The output value is never true: that is, always false, regardless of the input value of p.</p>
	
	<table style="width:25%">

		<tr>
			<th>p</th>
			<th>F</th>
		</tr>
		<tr>
			<td>T</td>
			<td>F</td>
		</tr>
		<tr>
			<td>F</td>
			<td>F</td>
		</tr>
	</table>
	
	<h3>Logical Identity</h3>
	
	<p>Logical identity is an operation on one logical value p, for which the output value remains p.<br>
	The truth table for the logical identity operator is as follows:</p>
	
	<table style="width:25%">

		<tr>
			<th>p</th>
			<th>p</th>
		</tr>
		<tr>
			<td>T</td>
			<td>T</td>
		</tr>
		<tr>
			<td>F</td>
			<td>F</td>
		</tr>
	</table>
	
	<h3>Logical Negation</h3>
	
	<p>Logical negation is an operation on one logical value, typically the value of a 
	proposition, that produces a value of true if its operand is false and a value of false 
	if its operand is true.<br>
	The truth table for NOT p (also written as ¬p, Np, Fpq, or ~p) is as follows:</p>
	
	<table style="width:25%">

		<tr>
			<th>p</th>
			<th>-p</th>
		</tr>
		<tr>
			<td>T</td>
			<td>F</td>
		</tr>
		<tr>
			<td>F</td>
			<td>T</td>
		</tr>
	</table>
	
	<h2>Binary Operations</h2>
	
	<p>There are 16 possible truth functions of two binary variables.<br>
	
	<div class="container-fluid">
	    <img src="assets/img/truthtable.png" class="img-thumbnail"alt="truthtable">
	</div>
	
	<p>The above table is the extended truth table giving definitions of all 16 of the possible
	truth functions of two binary variables (P and Q are thus boolean variables) where T = true 
	and F = false. The Com row indicates whether an operator, op, is commutative - P op Q = Q 
	op P. The L id row shows the operator's left identities if it has any - values I such that 
	I op Q = Q. The R id row shows the operator's right identities if it has any - values I such 
	that P op I = P.<br>
	The four combinations of input values for p, q, are read by row from the table above. 
	The output function for each p, q combination, can be read, by row, from the table.
	</p>
	
	<div class="container-fluid">
	    <img src="assets/img/truthtablecol.png" class="img-thumbnail" alt="truthtable">
	</div>
	
	<p>The above table is oriented by column, rather than by row. There are four columns rather 
	than four rows, to display the four combinations of p, q, as input.<br>
	p: T T F F<br>
	q: T F T F<br>
	There are 16 rows in this key, one row for each binary function of the two binary variables, p, q. 
	</p>
    </div>
HTML;

}



function chap10() {
    echo <<< HTML
    <div id="learningContent" >
        <h1>Chap 10 - Pseudocode</h1>
	
	<h2>Definition</h2>
	
	<p>Pseudocode: a program code unrelated to the hardware of a particular computer and 
	requiring conversion to the code used by the computer before the program can be used. 
	</p>

	<h2>Application</h2>
	
	<p>Pseudocode is used by many programmers to detail the requirements of a program. 
	When someone is writing pseudocode, it is written in a way that structures the design 
	and requirements of code that is going to be written. This is done with detailed statement 
	about what a program is going to do or what is to be done in a function call.<br>
	Pseudocode is first written in plain English to form the basics of what the program is going to do. <br><br>
	A programmer who needs to implement a specific algorithm, especially an unfamiliar one, 
	will often start with a pseudocode description, and then "translate" that description into the 
	target programming language and modify it to interact correctly with the rest of the program. 
	Programmers may also start a project by sketching out the code in pseudocode on paper before 
	writing it in its actual language, as a top-down structuring approach, with a process of steps 
	to be followed as a refinement.
	</p>
 
	<h2>Syntax</h2>
	
	<p>As the name suggests, pseudocode generally does not actually obey the syntax rules of any 
	particular language; there is no systematic standard form, although any particular writer will 
	generally borrow style and syntax; for example, control structures from some conventional 
	programming language. Popular syntax sources include Fortran, Pascal, BASIC, C, C++, Java, Lisp, 
	and ALGOL. Variable declarations are typically omitted. Function calls and blocks of code, such 
	as code contained within a loop, are often replaced by a one-line natural language sentence.<br><br>
	Depending on the writer, pseudocode may therefore vary widely in style, from a near-exact 
	imitation of a real programming language at one extreme, to a description approaching formatted 
	prose at the other.
	</p>
 
	<h2>Examples</h2>
	
	<h3>Fortran style pseudocode</h3>
	
	<p><tab1>program fizzbuzz<br>
	<tab2>Do i = 1 to 100<br>
	<tab3>set print_number to true<br>
	<tab3>If i is divisible by 3<br>
	<tab4>print "Fizz"<br>
	<tab4>set print_number to false<br>
	<tab3>If i is divisible by 5<br>
	<tab4>print "Buzz"<br>
	<tab4>set print_number to false<br>
	<tab3>If print_number, print i<br>
	<tab3>print a newline<br>
	<tab2>end do<br>
	</p>
	
	<h3>Pascal style pseudocode</h3>
	
	<p><tab1>procedure fizzbuzz<br>
	<tab2>For i := 1 to 100 do<br>
	<tab3>set print_number to true;<br>
	<tab3>If i is divisible by 3 then<br>
	<tab4>print "Fizz";<br>
	<tab4>set print_number to false;<br>
	<tab3>If i is divisible by 5 then<br>
	<tab4>print "Buzz";<br>
	<tab4>set print_number to false;<br>
	<tab3>If print_number, print i;<br>
	<tab3>print a newline;<br>
	<tab2>end<br>
	</p>
	
	<h3>C style pseudocode</h3>
	
	<p><tab1>void function fizzbuzz {<br>
	<tab2>for (i = 1; i <= 100; i++) {<br>
	<tab3>set print_number to true;<br>
	<tab3>If i is divisible by 3<br>
	<tab4>print "Fizz";<br>
	<tab4>set print_number to false;<br>
	<tab3>If i is divisible by 5<br>
	<tab4>print "Buzz";<br>
	<tab4>set print_number to false;<br>
	<tab3>If print_number, print i;<br>
	<tab3>print a newline;<br>
	<tab2>}<br>
	<tab1>}<br>
	</p>
	
	<h3>Basic style pseudocode</h3>
	
	<p><tab1>Sub fizzbuzz()<br>
	<tab2>For i = 1 to 100<br>
	<tab3>print_number = True<br>
	<tab3>If i is divisible by 3 Then<br>
	<tab4>Print "Fizz"<br>
	<tab4>print_number = False<br>
	<tab3>End If<br>
	<tab3>If i is divisible by 5 Then<br>
	<tab4>Print "Buzz"<br>
	<tab4>print_number = False<br>
	<tab3>End If<br>
	<tab3>If print_number = True, Then print i<br>
	<tab3>Print a newline<br>
	<tab2>Next i<br>
	<tab1>End Sub<br>
	</p>
 
	<h3>Plain English pseudocode</h3>
	
	<p><tab1>Program<br>
	<tab2>Loop from 1 to 100<br>
	<tab3>set print_number = True<br>
	<tab3>If i is divisible by 3 then<br>
	<tab4>Print "Fizz"<br>
	<tab4>set print_number = False<br>
	<tab3>End If<br>
	<tab3>If i is divisible by 5 then<br>
	<tab4>Print "Buzz"<br>
	<tab4>set print_number = False<br>
	<tab3>End If<br>
	<tab3>If print_number = True then<br>
	<tab4>Print i<br>
	<tab3>End If<br>
	<tab3>Print a newline<br>
	<tab2>Next value in Loop<br>
	<tab1>End Program<br>
	</p>
    </div>
HTML;

}










function underConstruction() {
    echo <<< HTML
    <div id="learningContent" >
    <h1> Under Construction</h1>
    </div>
HTML;

}
