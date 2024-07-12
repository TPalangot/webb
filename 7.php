EXP 7: 
Demonstrate a simple web application using PHP, MySQL. 
Using PHP and MYSQL, develop a program to accept book information viz. Accession Number, 
title, authors, edition and publisher from web page and store the information in a database 
and to search a book with the title specified by the user and to display the search results with 
proper headings. 
<!-- Mysql Setup: 
mysql -u root -p 
password:password 
Welcome to the MySQL monitor.  Commands end with ; or \g. 
Your MySQL connection id is 9 
Server version: 5.0.45 Source distribution 
Type 'help;' or '\h' for help. Type '\c' to clear the buffer. 
mysql> create database mydatabase; 
Query OK, 1 row affected (0.00 sec) 
mysql> use mydatabase 
Database changed 
mysql> create table book_info(acc_no int, title varchar(25), author varchar(25), edition 
varchar(25), publisher varchar(25)); 
Query OK, 0 rows affected (0.00 sec)  
<-Program7.html-> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
<title>Book Information</title> 
</head> 
<body> 
<form action="bookinfo.php" method="GET"> 
<h1>Enter the Book Details:</h1><br/> 
<h3>Accession No:</h3><input type="text" name="accno"/> 
<h3>Tiltle:</h3><input type="text" name="title"/> 
<h3>Author:</h3><input type="text" name="author"/> 
<h3>Edition:</h3><input type="text" name="edition"/> 
<h3>Publisher:</h3><input type="text" name="publisher"/><br/><br/> 
<input type="submit" value="Submit"/> 
<input type="reset" value="Reset"/>   
</form> 
<br/><br/> 
<a href="searchbook.html">Click here to Search a Book</a> 
</body> 
</html> 
<!--bookinfo.php--> 
<?php 
$con = new mysqli("localhost","root","password","mydatabase"); 
if ($con -> connect_errno)  
{ 
} 
echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
exit(); 
$accno=$_GET["accno"]; 
$title=$_GET["title"]; 
$author=$_GET["author"]; 
$edition=$_GET["edition"]; 
$publisher=$_GET["publisher"]; 
$sql="insert into book_info values($accno, '$title', '$author', '$edition', '$publisher')"; 
if(!($con->query($sql))) 
echo "Insertion failed"; 
else 
echo "Record Inserted Successfully" 
?> 
<!--searchbook.html--> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
<title>Search for a book</title> 
</head> 
<body> 
<form action="searchbook.php" method ="GET"> 
<label>Enter the title of the book<input type="text" name="title"/></label> 
<input type="submit" value="Submit"/> 
<input type="reset" value="Reset"/> 
</form> 
</body> 
</html> 
<!--searchbook.php--> 
<?php 
$con = new mysqli("localhost","root","password","mydatabase"); 
if ($con -> connect_errno)  
{ 
} 
echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
exit(); 
$title=$_GET['title']; 
$sql="select * from book_info where title like '$title'"; 
$result = $con->query($sql); 
if($result->num_rows > 0) 
{ 
echo "<table border=1><tr><th> 
Acc No</th><th>Title</th><th>Author</th> 
<th>Edition</th><th>Publisher</th></tr>"; 
while($row = $result -> fetch_row()) 
{ 
} 
echo "<tr><td>".$row[0]."</td><td>".$row[1]. 
"</td><td>".$row[2]."</td><td>".$row[3]. 
"</td><td>".$row[4]."</tr>"; 
echo "</table>"; 
} 
else 
echo "Record not found"; 
?> 