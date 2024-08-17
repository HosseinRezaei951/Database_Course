<html>
	<head>
		<title>MY DataBase</title>
	</head>
<body>

		<form action="index.php" method="post">

			<!-- ***************************** Employee ***************************** -->
			<b>::::Employee table::::</b><br>
			<input type="submit" name="Show_Employee_tbl" value="Show Employee table"><br>

			<br>
			<b>Adding and Searching record in <i>Employee</i> table:</b><br>
			1- Fname 		<input type="text" name="Fname"><br>
			2- Minit 		<input type="text" name="Minit"><br>
			3- Lname 		<input type="text" name="Lname"><br>
			4- Ssn 			<input type="text" name="Ssn"><br>
			5- Bdate 		<input type="text" name="Bdate"><br>
			6- Address 		<input type="text" name="Address"><br>
			7- Sex 		    <input type="text" name="Sex"><br>
			8- Salary 		<input type="text" name="Salary"><br>
			9- Super_ssn 	<input type="text" name="Super_ssn"><br>
			10- Dno			<input type="text" name="Dno"><br>
			==> <input type="submit" name="Add_Employee" value="Adding a record to Employee table"><br>	
			==> <input type="submit" name="Search_Employee" value="Searching a record from Employee table"><br>	
			<br>
			<b>Deleting a record from <i>Employee</i> table:</b><br>
			11- Ssn 		<input type="text" name="Delete_Ssn"><br>
			==> <input type="submit" name="Delete_Employee" value="Deleting a record from Employee table"><br>	


		</form>
		
<?php
// establishing the MySQLi connection
$con = new mysqli("localhost","root","","company");
if (mysqli_connect_errno())
{
	echo "MySQLi Connection was not established: " . mysqli_connect_error();
}

// add new Employee
if (isset($_POST['Add_Employee']))
{
	$Fname = $_POST['Fname'];
	$Minit = $_POST['Minit'];
	$Lname = $_POST['Lname'];
	$Ssn = $_POST['Ssn'];
	$Bdate = $_POST['Bdate'];
	$Address = $_POST['Address'];
	$Sex = $_POST['Sex'];
	$Salary = $_POST['Salary'];
	$Super_ssn = $_POST['Super_ssn'];
	$Dno = $_POST['Dno'];

	if($Fname == "" || $Minit == "" || $Lname == "" || $Ssn == "" || $Bdate == "" ||
		$Address == "" || $Sex == "" || $Salary == "" || $Super_ssn == "" || $Dno == "")
	{
		echo "<script>alert('you should fill all the boxes(1 to 10)')</script>";
	}
	else
	{
		$check = "SELECT * FROM employee WHERE Ssn LIKE '$Ssn'";
		$run = $con->query($check);
		$run = mysqli_fetch_array($run);
		if(!empty($run))
		{
			
			$query = "UPDATE employee SET Fname = '$Fname', Minit = '$Minit', 
					Lname = '$Lname' , Bdate = '$Bdate' , Address = '$Address' , Sex = '$Sex' , Salary = '$Salary' 
					, Super_ssn = '$Super_ssn' , Dno = '$Dno' WHERE Ssn LIKE '$Ssn'";

			if ($con->query($query) === TRUE)
			{	
		     	echo "there is another employee with this Ssn.==> <b>Record updated successfully<b>";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		else
		{
			$query = "INSERT INTO employee (Fname, Minit, Lname,Ssn,Bdate,Address,Sex,Salary,Super_ssn,Dno)
			VALUES ('$Fname','$Minit','$Lname','$Ssn','$Bdate','$Address','$Sex','$Salary','$Super_ssn','$Dno')";
			if ($con->query($query) === TRUE)
			{
		   		echo "New record created successfully";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
	}
}

// delete Employee
if(isset($_POST['Delete_Employee']))
{
	$Delete_Ssn = $_POST['Delete_Ssn'];
	if($Delete_Ssn == "")
	{
		echo "<script>alert('you should fill the (11- Ssn) box for delete')</script>";
	}
	else
	{
		$check = "SELECT * FROM employee WHERE Ssn LIKE '$Delete_Ssn'";
		$run = $con->query($check);
		$run = mysqli_fetch_array($run);
		if(!empty($run))
		{
			$query = " DELETE FROM employee WHERE Ssn LIKE '$Delete_Ssn' ";
			if ($con->query($query) === TRUE)
			{
		    	echo "record deleted successfully";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		else
		{
			echo "record not found";
		}
	}
}

// search Employee
if(isset($_POST['Search_Employee']))
{

	$Fname = $_POST['Fname'];
	$Minit = $_POST['Minit'];
	$Lname = $_POST['Lname'];
	$Ssn = $_POST['Ssn'];
	$Bdate = $_POST['Bdate'];
	$Address = $_POST['Address'];
	$Sex = $_POST['Sex'];
	$Salary = $_POST['Salary'];
	$Super_ssn = $_POST['Super_ssn'];
	$Dno = $_POST['Dno'];
	if($Fname == "" && $Minit == "" && $Lname == "" && $Ssn == "" && $Bdate == "" &&
		$Address == "" && $Sex == "" && $Salary == "" && $Super_ssn == "" && $Dno == "")
	{
		echo "<script>alert('you should fill one of the boxes(1 to 10)')</script>";
	}
	else
	{
		$search = "SELECT * FROM employee WHERE Fname LIKE '$Fname' OR Minit LIKE '$Minit' OR Lname LIKE '$Lname' OR Ssn LIKE '$Ssn' OR Bdate = '$Bdate' OR Address LIKE '$Address' OR Sex LIKE '$Sex' OR Salary = '$Salary' OR Super_ssn LIKE '$Super_ssn' OR Dno = '$Dno'";
		$run = mysqli_query($con,$search);
		$row = mysqli_fetch_array($run);
		if(!empty($row))
		{
			echo "<br><b>Searching Employee Table Result</b>";
			echo "<table border='1'>
			<tr>
				<th>Fname</th>
				<th>Minit</th>
				<th>Lname</th>
				<th>Ssn</th>
				<th>Bdate</th>
				<th>Address</th>
				<th>Sex</th>
				<th>Salary</th>
				<th>Super_ssn</th>
				<th>Dno</th>
			</tr>";
			echo "<tr>";
				echo "<td>" . $row['Fname'] . "</td>";
				echo "<td>" . $row['Minit'] . "</td>";
				echo "<td>" . $row['Lname'] . "</td>";
				echo "<td>" . $row['Ssn'] . "</td>";
				echo "<td>" . $row['Bdate'] . "</td>";
				echo "<td>" . $row['Address'] . "</td>";
				echo "<td>" . $row['Sex'] . "</td>";
				echo "<td>" . $row['Salary'] . "</td>";
				echo "<td>" . $row['Super_ssn'] . "</td>";
				echo "<td>" . $row['Dno'] . "</td>";
			echo "</tr>";

			while($row = mysqli_fetch_array($run))
			{
			echo "<tr>";
				echo "<td>" . $row['Fname'] . "</td>";
				echo "<td>" . $row['Minit'] . "</td>";
				echo "<td>" . $row['Lname'] . "</td>";
				echo "<td>" . $row['Ssn'] . "</td>";
				echo "<td>" . $row['Bdate'] . "</td>";
				echo "<td>" . $row['Address'] . "</td>";
				echo "<td>" . $row['Sex'] . "</td>";
				echo "<td>" . $row['Salary'] . "</td>";
				echo "<td>" . $row['Super_ssn'] . "</td>";
				echo "<td>" . $row['Dno'] . "</td>";
			echo "</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "nothing found !!!";
		}
	}
}

// show Employee Table
if (isset($_POST['Show_Employee_tbl']))
{
	echo "<br><b>Employee Table</b>";
	$result = mysqli_query($con,"SELECT * FROM employee");
	echo "<table border='1'>
	<tr>
		<th>Fname</th>
		<th>Minit</th>
		<th>Lname</th>
		<th>Ssn</th>
		<th>Bdate</th>
		<th>Address</th>
		<th>Sex</th>
		<th>Salary</th>
		<th>Super_ssn</th>
		<th>Dno</th>
	</tr>";

	while($row = mysqli_fetch_array($result))
	{
	echo "<tr>";
		echo "<td>" . $row['Fname'] . "</td>";
		echo "<td>" . $row['Minit'] . "</td>";
		echo "<td>" . $row['Lname'] . "</td>";
		echo "<td>" . $row['Ssn'] . "</td>";
		echo "<td>" . $row['Bdate'] . "</td>";
		echo "<td>" . $row['Address'] . "</td>";
		echo "<td>" . $row['Sex'] . "</td>";
		echo "<td>" . $row['Salary'] . "</td>";
		echo "<td>" . $row['Super_ssn'] . "</td>";
		echo "<td>" . $row['Dno'] . "</td>";
	echo "</tr>";
	}
	echo "</table>";	
}

?>

		<form action="index.php" method="post">

			<!-- ***************************** Project ***************************** -->
			<br><br><br><br><br>
			<b>::::Project table::::</b><br>
			<input type="submit" name="Show_Project_tbl" value="Show Project table"><br>

			<br>
			<b>Adding and Searching record in <i>Project</i> table:</b><br>
			12- Pname 		<input type="text" name="Pname"><br>
			13- Pnumber 	<input type="text" name="Pnumber"><br>
			14- Plocation 	<input type="text" name="Plocation"><br>
			15- Dnum 		<input type="text" name="Dnum"><br>
			==> <input type="submit" name="Add_Project" value="Adding a record to Project table"><br>	
			==> <input type="submit" name="Search_Project" value="Searching a record from Project table"><br>	

			<br>
			<b>Deleting a record from <i>Project</i> table:</b><br>
			16- Pnumber 	<input type="text" name="Delete_Pnumber"><br>
			==> <input type="submit" name="Delete_Project" value="Deleting a record from Project table"><br>	

		</form>

<?php
// establishing the MySQLi connection
$con = new mysqli("localhost","root","","company");
if (mysqli_connect_errno())
{
	echo "MySQLi Connection was not established: " . mysqli_connect_error();
}

// add new Project
if (isset($_POST['Add_Project']))
{
	$Pname = $_POST['Pname'];
	$Pnumber = $_POST['Pnumber'];
	$Plocation = $_POST['Plocation'];
	$Dnum = $_POST['Dnum'];
	
	if($Pname == "" || $Pnumber == "" || $Plocation == "" || $Dnum == "")
	{
		echo "<script>alert('you should fill all the boxes(12 to 15)')</script>";
	}
	else
	{
		$check = "SELECT * FROM project WHERE Pnumber = '$Pnumber'";
		$run = $con->query($check);
		$run = mysqli_fetch_array($run);
		if(!empty($run))
		{
			
			$query = "UPDATE project SET Pname = '$Pname', Plocation = '$Plocation', 
					Dnum = '$Dnum' WHERE Pnumber = '$Pnumber'";

			if ($con->query($query) === TRUE)
			{	
		     	echo "there is another project with this Pnumber.==> <b>Record updated successfully<b>";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		else
		{
			$query = "INSERT INTO project (Pname, Pnumber, Plocation,Dnum)
			VALUES ('$Pname', '$Pnumber', '$Plocation','$Dnum')";
			if ($con->query($query) === TRUE)
			{
		   		echo "New record created successfully";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
	}
}

// delete Project
if(isset($_POST['Delete_Project']))
{
	$Delete_Pnumber = $_POST['Delete_Pnumber'];
	if($Delete_Pnumber == "")
	{
		echo "<script>alert('you should fill the (16- Pnumber) box for delete')</script>";
	}
	else
	{
		$check = "SELECT * FROM project WHERE Pnumber = '$Delete_Pnumber'";
		$run = $con->query($check);
		$run = mysqli_fetch_array($run);
		if(!empty($run))
		{
			$query = " DELETE FROM project WHERE Pnumber = '$Delete_Pnumber' ";
			if ($con->query($query) === TRUE)
			{
		    	echo "record deleted successfully";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		else
		{
			echo "record not found";
		}
	}
}

// search Project
if(isset($_POST['Search_Project']))
{
	$Pname = $_POST['Pname'];
	$Pnumber = $_POST['Pnumber'];
	$Plocation = $_POST['Plocation'];
	$Dnum = $_POST['Dnum'];
	if($Pname == "" && $Pnumber == "" && $Plocation == "" && $Dnum == "")
	{
		echo "<script>alert('you should fill one of the boxes(12 to 15)')</script>";
	}
	else
	{
		$search = "SELECT * FROM project WHERE Pname LIKE '$Pname' OR Pnumber = '$Pnumber' OR Plocation LIKE '$Plocation' OR Dnum = '$Dnum'";
		$run = mysqli_query($con,$search);
		$row = mysqli_fetch_array($run);
		if(!empty($row))
		{
			echo "<br><b>Searching Project Table Result</b>";
			echo "<table border='1'>
			<tr>
				<th>Pname</th>
				<th>Pnumber</th>
				<th>Plocation</th>
				<th>Dnum</th>
			</tr>";
			echo "<tr>";
				echo "<td>" . $row['Pname'] . "</td>";
				echo "<td>" . $row['Pnumber'] . "</td>";
				echo "<td>" . $row['Plocation'] . "</td>";
				echo "<td>" . $row['Dnum'] . "</td>";
				
			echo "</tr>";

			while($row = mysqli_fetch_array($run))
			{
			echo "<tr>";
				echo "<td>" . $row['Pname'] . "</td>";
				echo "<td>" . $row['Pnumber'] . "</td>";
				echo "<td>" . $row['Plocation'] . "</td>";
				echo "<td>" . $row['Dnum'] . "</td>";
				
			echo "</tr>";
			}
			echo "</table>";	
		}
		else
		{
			echo "nothing found !!!";
		}
	}
}

// show Project Table
if (isset($_POST['Show_Project_tbl']))
{
	echo "<br><b>Project Table</b>";
	$result = mysqli_query($con,"SELECT * FROM project");
	echo "<table border='1'>
	<tr>
		<th>Pname</th>
		<th>Pnumber</th>
		<th>Plocation</th>
		<th>Dnum</th>
	</tr>";

	while($row = mysqli_fetch_array($result))
	{
	echo "<tr>";
		echo "<td>" . $row['Pname'] . "</td>";
		echo "<td>" . $row['Pnumber'] . "</td>";
		echo "<td>" . $row['Plocation'] . "</td>";
		echo "<td>" . $row['Dnum'] . "</td>";
		
	echo "</tr>";
	}
	echo "</table>";	
}

?>

		<form action="index.php" method="post">

			<!-- ***************************** Department ***************************** -->
			<br><br><br><br><br>
			<b>::::Department table::::</b><br>
			<input type="submit" name="Show_Department_tbl" value="Show Department table"><br>

			<br>
			<b>Adding and Searching record in <i>Department</i> table:</b><br>
			17- Dname 		<input type="text" name="Dname"><br>
			18- Dnumber 	<input type="text" name="Dnumber"><br>
			19- Mgr_ssn		<input type="text" name="Mgr_ssn"><br>
			20- Mgr_start_date		 <input type="text" name="Mgr_start_date"><br>
			==> <input type="submit" name="Add_Department" value="Adding a record to Department table"><br>	
			==> <input type="submit" name="Search_Department" value="Searching a record from Department table"><br>	

			<br>
			<b>Deleting a record from <i>Department</i> table:</b><br>
			21- Dnumber 	<input type="text" name="Delete_Dnumber"><br>
			==> <input type="submit" name="Delete_Department" value="Deleting a record from Department table"><br>	

		</form>

<?php
// establishing the MySQLi connection
$con = new mysqli("localhost","root","","company");
if (mysqli_connect_errno())
{
	echo "MySQLi Connection was not established: " . mysqli_connect_error();
}

// add new Department
if (isset($_POST['Add_Department']))
{
	$Dname = $_POST['Dname'];
	$Dnumber = $_POST['Dnumber'];
	$Mgr_ssn = $_POST['Mgr_ssn'];
	$Mgr_start_date = $_POST['Mgr_start_date'];
	
	if($Dname == "" || $Dnumber == "" || $Mgr_ssn == "" || $Mgr_start_date == "")
	{
		echo "<script>alert('you should fill all the boxes(17 to 20)')</script>";
	}
	else
	{
		$check = "SELECT * FROM department WHERE Dnumber = '$Dnumber'";
		$run = $con->query($check);
		$run = mysqli_fetch_array($run);
		if(!empty($run))
		{
			
			$query = "UPDATE department SET Dname = '$Dname', Mgr_ssn = '$Mgr_ssn', 
					Mgr_start_date = '$Mgr_start_date' WHERE Dnumber = '$Dnumber'";

			if ($con->query($query) === TRUE)
			{	
		     	echo "there is another department with this Dnumber.==> <b>Record updated successfully<b>";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		else
		{
			$query = "INSERT INTO department (Dname, Dnumber, Mgr_ssn,Mgr_start_date)
			VALUES ('$Dname', '$Dnumber', '$Mgr_ssn','$Mgr_start_date')";
			if ($con->query($query) === TRUE)
			{
		   		echo "New record created successfully";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
	}
}

// delete Department
if(isset($_POST['Delete_Department']))
{
	$Delete_Dnumber = $_POST['Delete_Dnumber'];
	if($Delete_Dnumber == "")
	{
		echo "<script>alert('you should fill the (21- Pnumber) box for delete')</script>";
	}
	else
	{
		$check = "SELECT * FROM department WHERE Dnumber = '$Delete_Dnumber'";
		$run = $con->query($check);
		$run = mysqli_fetch_array($run);
		if(!empty($run))
		{
			$query = " DELETE FROM department WHERE Dnumber = '$Delete_Dnumber' ";
			if ($con->query($query) === TRUE)
			{
		    	echo "record deleted successfully";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		else
		{
			echo "record not found";
		}
	}
}

// search Department
if(isset($_POST['Search_Department']))
{
	$Dname = $_POST['Dname'];
	$Dnumber = $_POST['Dnumber'];
	$Mgr_ssn = $_POST['Mgr_ssn'];
	$Mgr_start_date = $_POST['Mgr_start_date'];
	if($Dname == "" && $Dnumber == "" && $Mgr_ssn == "" && $Mgr_start_date == "")
	{
		echo "<script>alert('you should fill one of the boxes(17 to 20)')</script>";
	}
	else
	{
		$search = "SELECT * FROM department WHERE Dname LIKE '$Dname' OR Dnumber = '$Dnumber' OR Mgr_ssn LIKE '$Mgr_ssn' OR Mgr_start_date = '$Mgr_start_date'";
		$run = mysqli_query($con,$search);
		$row = mysqli_fetch_array($run);
		if(!empty($row))
		{
			echo "<br><b>Searching Department Table Result</b>";
			echo "<table border='1'>
			<tr>
				<th>Dname</th>
				<th>Dnumber</th>
				<th>Mgr_ssn</th>
				<th>Mgr_start_date</th>
			</tr>";
			echo "<tr>";
				echo "<td>" . $row['Dname'] . "</td>";
				echo "<td>" . $row['Dnumber'] . "</td>";
				echo "<td>" . $row['Mgr_ssn'] . "</td>";
				echo "<td>" . $row['Mgr_start_date'] . "</td>";
				
			echo "</tr>";

			while($row = mysqli_fetch_array($run))
			{
			echo "<tr>";
				echo "<td>" . $row['Dname'] . "</td>";
				echo "<td>" . $row['Dnumber'] . "</td>";
				echo "<td>" . $row['Mgr_ssn'] . "</td>";
				echo "<td>" . $row['Mgr_start_date'] . "</td>";
				
			echo "</tr>";
			}
			echo "</table>";	
		}
		else
		{
			echo "nothing found !!!";
		}
	}
}

// show Department Table
if (isset($_POST['Show_Department_tbl']))
{
	echo "<br><b>Department Table</b>";
	$result = mysqli_query($con,"SELECT * FROM department");
	echo "<table border='1'>
	<tr>
		<th>Dname</th>
		<th>Dnumber</th>
		<th>Mgr_ssn</th>
		<th>Mgr_start_date</th>
	</tr>";

	while($row = mysqli_fetch_array($result))
	{
	echo "<tr>";
		echo "<td>" . $row['Dname'] . "</td>";
		echo "<td>" . $row['Dnumber'] . "</td>";
		echo "<td>" . $row['Mgr_ssn'] . "</td>";
		echo "<td>" . $row['Mgr_start_date'] . "</td>";
		
	echo "</tr>";
	}
	echo "</table>";	
}

?>


		<form action="index.php" method="post">

			<!-- ***************************** Dependent ***************************** -->
			<br><br><br><br><br>
			<b>::::Dependent table::::</b><br>
			<input type="submit" name="Show_Dependent_tbl" value="Show Dependent table"><br>

			<br>
			<b>Adding and Searching record in <i>Dependent</i> table:</b><br>
			22- Essn 				<input type="text" name="Essn"><br>
			23- Dependent_name 		<input type="text" name="Dependent_name"><br>
			24- Dependent_Sex		<input type="text" name="Dependent_Sex"><br>
			25- Dependent_Bdate		 <input type="text" name="Dependent_Bdate"><br>
			26- Relationship		 <input type="text" name="Relationship"><br>
			==> <input type="submit" name="Add_Dependent" value="Adding a record to Dependent table"><br>	
			==> <input type="submit" name="Search_Dependent" value="Searching a record from Dependent table"><br>	

			<br>
			<b>Deleting a record from <i>Dependent</i> table:</b><br>
			27- Essn 	<input type="text" name="Delete_Essn"><br>
			28- Dependent_name 	<input type="text" name="Delete_Dependent_name"><br>
			==> <input type="submit" name="Delete_Dependent" value="Deleting a record from Dependent table"><br>	

		</form>

<?php
// establishing the MySQLi connection
$con = new mysqli("localhost","root","","company");
if (mysqli_connect_errno())
{
	echo "MySQLi Connection was not established: " . mysqli_connect_error();
}

// add new Dependent
if (isset($_POST['Add_Dependent']))
{
	$Essn = $_POST['Essn'];
	$Dependent_name = $_POST['Dependent_name'];
	$Dependent_Sex = $_POST['Dependent_Sex'];
	$Dependent_Bdate = $_POST['Dependent_Bdate'];
	$Relationship = $_POST['Relationship'];

	if($Essn == "" || $Dependent_name == "" || $Dependent_Sex == "" || $Dependent_Bdate == "" || $Relationship == "")
	{
		echo "<script>alert('you should fill all the boxes(22 to 26)')</script>";
	}
	else
	{
		$check = "SELECT * FROM dependent WHERE (Essn = '$Essn' AND Dependent_name = '$Dependent_name')";
		$check2 = "SELECT * FROM employee WHERE Ssn = '$Essn'";

		$run = $con->query($check);
		$run = mysqli_fetch_array($run);
		$run2 =  $con->query($check2);
		$run2 = mysqli_fetch_array($run2);
		if(!empty($run))
		{
			
			$query = "UPDATE dependent SET Sex = '$Dependent_Sex', Bdate = '$Dependent_Bdate', 
					Relationship = '$Relationship' WHERE (Essn LIKE '$Essn' AND Dependent_name LIKE '$Dependent_name)'";

			if ($con->query($query) === TRUE)
			{	
		     	echo "there is another dependent with this Essn and Dependent_name.==> <b>Record updated successfully<b>";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		if(empty($run) && !empty($run2))
		{
			$query = "INSERT INTO dependent (Essn, Dependent_name, Sex,Bdate,Relationship)
			VALUES ('$Essn', '$Dependent_name', '$Dependent_Sex','$Dependent_Bdate','$Relationship')";
			if ($con->query($query) === TRUE)
			{
		   		echo "New record created successfully";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		else
		{
			echo "this Essn is not in the Employee table.==> <b>You cant add this dependent<b>";
		}
	}
}

// delete Dependent
if(isset($_POST['Delete_Dependent']))
{
	$Delete_Essn = $_POST['Delete_Essn'];
	$Delete_Dependent_name = $_POST['Delete_Dependent_name'];
	if($Delete_Essn == "" || $Delete_Dependent_name == "")
	{
		echo "<script>alert('you should fill the (27- Essn and 28- Dependent_name) boxes for delete')</script>";
	}
	else 
	{
		$check = "SELECT * FROM dependent WHERE (Essn LIKE '$Delete_Essn' AND Dependent_name LIKE '$Delete_Dependent_name')";
		$run = $con->query($check);
		$run = mysqli_fetch_array($run);
		if(!empty($run))
		{
			$query = " DELETE FROM dependent WHERE (Essn LIKE '$Delete_Essn' AND Dependent_name LIKE '$Delete_Dependent_name')";
			if ($con->query($query) === TRUE)
			{
		    	echo "record deleted successfully";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		else
		{
			echo "record not found";
		}
	}
}

// search Dependent
if(isset($_POST['Search_Dependent']))
{
	$Essn = $_POST['Essn'];
	$Dependent_name = $_POST['Dependent_name'];
	$Dependent_Sex = $_POST['Dependent_Sex'];
	$Dependent_Bdate = $_POST['Dependent_Bdate'];
	$Relationship = $_POST['Relationship'];

	if($Essn == "" && $Dependent_name == "" && $Dependent_Sex == "" && $Dependent_Bdate == "" && $Relationship == "")
	{
		echo "<script>alert('you should fill one of the boxes(22 to 26)')</script>";
	}
	else
	{
		$search = "SELECT * FROM dependent WHERE Essn LIKE '$Essn' OR Dependent_name LIKE '$Dependent_name' OR Sex LIKE '$Dependent_Sex' OR Bdate = '$Dependent_Bdate' OR Relationship LIKE '$Relationship'";
		$run = mysqli_query($con,$search);
		$row = mysqli_fetch_array($run);
		if(!empty($row))
		{
			echo "<br><b>Searching Dependent Table Result</b>";
			echo "<table border='1'>
			<tr>
				<th>Essn</th>
				<th>Dependent_name</th>
				<th>Dependent_Sex</th>
				<th>Dependent_Bdate</th>
				<th>Relationship</th>
			</tr>";
			echo "<tr>";
				echo "<td>" . $row['Essn'] . "</td>";
				echo "<td>" . $row['Dependent_name'] . "</td>";
				echo "<td>" . $row['Sex'] . "</td>";
				echo "<td>" . $row['Bdate'] . "</td>";
				echo "<td>" . $row['Relationship'] . "</td>";

			echo "</tr>";

			while($row = mysqli_fetch_array($run))
			{
			echo "<tr>";
				echo "<td>" . $row['Essn'] . "</td>";
				echo "<td>" . $row['Dependent_name'] . "</td>";
				echo "<td>" . $row['Sex'] . "</td>";
				echo "<td>" . $row['Bdate'] . "</td>";
				echo "<td>" . $row['Relationship'] . "</td>";
				
			echo "</tr>";
			}
			echo "</table>";	
		}
		else
		{
			echo "nothing found !!!";
		}
	}
}

// show Dependent Table
if (isset($_POST['Show_Dependent_tbl']))
{
	echo "<br><b>Dependent Table</b>";
	$result = mysqli_query($con,"SELECT * FROM dependent");
	echo "<table border='1'>
	<tr>
		<th>Essn</th>
		<th>Dependent_name</th>
		<th>Dependent_Sex</th>
		<th>Dependent_Bdate</th>
		<th>Relationship</th>
	</tr>";

	while($row = mysqli_fetch_array($result))
	{
	echo "<tr>";
		echo "<td>" . $row['Essn'] . "</td>";
		echo "<td>" . $row['Dependent_name'] . "</td>";
		echo "<td>" . $row['Sex'] . "</td>";
		echo "<td>" . $row['Bdate'] . "</td>";
		echo "<td>" . $row['Relationship'] . "</td>";
		
	echo "</tr>";
	}
	echo "</table>";	
}

?>


		<form action="index.php" method="post">

			<!-- ***************************** Dept_Locations ***************************** -->
			<br><br><br><br><br>
			<b>::::Dept_Locations table::::</b><br>
			<input type="submit" name="Show_Dept_Locations_tbl" value="Show Dept_Locations table"><br>

			<br>
			<b>Adding and Searching record in <i>Dept_Locations</i> table:</b><br>
			29- Dept_Locations_Dnumber 		<input type="text" name="Dept_Locations_Dnumber"><br>
			30- Dlocation 		<input type="text" name="Dlocation"><br>
			==> <input type="submit" name="Add_Dept_Locations" value="Adding a record to Dept_Locations table"><br>	
			==> <input type="submit" name="Search_Dept_Locations" value="Searching a record from Dept_Locations table"><br>	

			<br>
			<b>Deleting a record from <i>Dept_Locations</i> table:</b><br>
			31- Dept_Locations_Dnumber 	<input type="text" name="Delete_Dept_Locations_Dnumber"><br>
			32- Dlocation 	<input type="text" name="Delete_Dlocation"><br>
			==> <input type="submit" name="Delete_Dept_Locations" value="Deleting a record from Dept_Locations table"><br>	

		</form>

<?php
// establishing the MySQLi connection
$con = new mysqli("localhost","root","","company");
if (mysqli_connect_errno())
{
	echo "MySQLi Connection was not established: " . mysqli_connect_error();
}

// add new Dept_Locations
if (isset($_POST['Add_Dept_Locations']))
{
	$Dept_Locations_Dnumber = $_POST['Dept_Locations_Dnumber'];
	$Dlocation = $_POST['Dlocation'];
	

	if($Dept_Locations_Dnumber == "" || $Dlocation == "" )
	{
		echo "<script>alert('you should fill all the boxes(29 to 30)')</script>";
	}
	else
	{
		$check = "SELECT * FROM dept_locations WHERE (Dnumber = '$Dept_Locations_Dnumber' AND Dlocation LIKE '$Dlocation')";
		$check2 = "SELECT * FROM department WHERE (Dnumber = '$Dept_Locations_Dnumber'";
		
		$run = $con->query($check);
		$run = mysqli_fetch_array($run);
		$run2 = $con->query($check2);
		$run2 = mysqli_fetch_array($run2);
		if(!empty($run))
		{
			echo "there is another dept_locations with this Dnumber and Dlocation. ==> <b>You cant update this data !!!<b>";
		}
		elseif(empty($run) && !empty($run2))
		{
			$query = "INSERT INTO dept_locations (Dnumber, Dlocation)
					VALUES ('$Dept_Locations_Dnumber', '$Dlocation')";
			if ($con->query($query) === TRUE)
			{
		   		echo "New record created successfully";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		
	}
}

// delete Dept_Locations
if(isset($_POST['Delete_Dept_Locations']))
{
	$Delete_Dept_Locations_Dnumber = $_POST['Delete_Dept_Locations_Dnumber'];
	$Delete_Dlocation = $_POST['Delete_Dlocation'];
	if($Delete_Dept_Locations_Dnumber == "" || $Delete_Dlocation == "")
	{
		echo "<script>alert('you should fill the (31- Dept_Locations_Dnumber and 32- Dlocation) boxes for delete')</script>";
	}
	else 
	{
		$check = "SELECT * FROM dept_locations WHERE (Dnumber = '$Delete_Dept_Locations_Dnumber' AND Dlocation LIKE '$Delete_Dlocation')";
		$run = $con->query($check);
		$run = mysqli_fetch_array($run);
		if(!empty($run))
		{
			$query = " DELETE FROM dept_locations WHERE (Dnumber = '$Delete_Dept_Locations_Dnumber' AND Dlocation LIKE '$Delete_Dlocation')";
			if ($con->query($query) === TRUE)
			{
		    	echo "record deleted successfully";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		else
		{
			echo "record not found";
		}
	}
}

// search Dept_Locations
if(isset($_POST['Search_Dept_Locations']))
{
	$Dept_Locations_Dnumber = $_POST['Dept_Locations_Dnumber'];
	$Dlocation = $_POST['Dlocation'];

	if($Dept_Locations_Dnumber == "" && $Dlocation == "")
	{
		echo "<script>alert('you should fill one of the boxes(29 to 30)')</script>";
	}
	else
	{
		$search = "SELECT * FROM dept_locations WHERE Dnumber = '$Dept_Locations_Dnumber' OR Dlocation LIKE '$Dlocation'";
		$run = mysqli_query($con,$search);
		$row = mysqli_fetch_array($run);
		if(!empty($row))
		{
			echo "<br><b>Searching dept_locations Table Result</b>";
			echo "<table border='1'>
			<tr>
				<th>Dept_Locations_Dnumber</th>
				<th>Dlocation</th>
			</tr>";
			echo "<tr>";
				echo "<td>" . $row['Dnumber'] . "</td>";
				echo "<td>" . $row['Dlocation'] . "</td>";

			echo "</tr>";

			while($row = mysqli_fetch_array($run))
			{
			echo "<tr>";
				echo "<td>" . $row['Dnumber'] . "</td>";
				echo "<td>" . $row['Dlocation'] . "</td>";
				
			echo "</tr>";
			}
			echo "</table>";	
		}
		else
		{
			echo "nothing found !!!";
		}
	}
}

// show Dept_Locations Table
	if (isset($_POST['Show_Dept_Locations_tbl']))
{
	echo "<br><b>Dept_Locations Table</b>";
	$result = mysqli_query($con,"SELECT * FROM Dept_Locations");
	echo "<table border='1'>
	<tr>
		<th>Dept_Locations_Dnumber</th>
		<th>Dlocation</th>
	</tr>";

	while($row = mysqli_fetch_array($result))
	{
	echo "<tr>";
		echo "<td>" . $row['Dnumber'] . "</td>";
		echo "<td>" . $row['Dlocation'] . "</td>";
		
	echo "</tr>";
	}
	echo "</table>";	
}

?>

		<form action="index.php" method="post">

			<!-- ***************************** Works_On ***************************** -->
			<br><br><br><br><br>
			<b>::::Works_On table::::</b><br>
			<input type="submit" name="Show_Works_On_tbl" value="Show Works_On table"><br>

			<br>
			<b>Adding and Searching record in <i>Works_On</i> table:</b><br>
			33- Works_On_Essn 		<input type="text" name="Works_On_Essn"><br>
			34- Pno 		<input type="text" name="Pno"><br>
			35- Hours 		<input type="text" name="Hours"><br>
			==> <input type="submit" name="Add_Works_On" value="Adding a record to Works_On table"><br>	
			==> <input type="submit" name="Search_Works_On" value="Searching a record from Works_On table"><br>	

			<br>
			<b>Deleting a record from <i>Works_On</i> table:</b><br>
			36- Works_On_Essn 	<input type="text" name="Delete_Works_On_Essn"><br>
			37- Pno 	<input type="text" name="Delete_Pno"><br>
			==> <input type="submit" name="Delete_Works_On" value="Deleting a record from Works_On table"><br>	

		</form>

<?php
// establishing the MySQLi connection
$con = new mysqli("localhost","root","","company");
if (mysqli_connect_errno())
{
	echo "MySQLi Connection was not established: " . mysqli_connect_error();
}

// add new Works_On
if (isset($_POST['Add_Works_On']))
{
	$Works_On_Essn = $_POST['Works_On_Essn'];
	$Pno = $_POST['Pno'];
	$Hours = $_POST['Hours'];

	if($Works_On_Essn == "" || $Pno == "" || $Hours == "")
	{
		echo "<script>alert('you should fill all the boxes(33 to 35)')</script>";
	}
	else
	{
		$check = "SELECT * FROM works_on WHERE (Essn LIKE '$Works_On_Essn' AND Pno = '$Pno')";
		$check2 = "SELECT * FROM employee WHERE Ssn LIKE '$Works_On_Essn'";
		$check3 = "SELECT * FROM project WHERE Pnumber = '$Pno'";
		
		$run = $con->query($check);
		$run = mysqli_fetch_array($run);
		$run2 = $con->query($check2);
		$run2 = mysqli_fetch_array($run2);
		$run3 = $con->query($check3);
		$run3 = mysqli_fetch_array($run3);
		if(!empty($run))
		{
			$query = "UPDATE works_on SET Hours = '$Hours' WHERE (Essn LIKE '$Works_On_Essn' AND Pno = '$Pno')";

			if ($con->query($query) === TRUE)
			{	
		     	echo "there is another works_on with this Essn and Pno. ==> <b>Record updated successfully<b>";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
			
		}
		elseif(empty($run) && !empty($run2) && !empty($run3))
		{
			$query = "INSERT INTO works_on (Essn, Pno, Hours)
					VALUES ('$Works_On_Essn','$Pno' ,'$Hours')";
			if ($con->query($query) === TRUE)
			{
		   		echo "New record created successfully";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		else
		{
			echo "there is not employee with this Essn (or project with this Pno). ==> <b>You cant add this record<b>";
		}
		
	}
}

// delete Works_On
if(isset($_POST['Delete_Works_On']))
{
	$Delete_Works_On_Essn = $_POST['Delete_Works_On_Essn'];
	$Delete_Pno = $_POST['Delete_Pno'];
	if($Delete_Works_On_Essn == "" || $Delete_Pno == "")
	{
		echo "<script>alert('you should fill the (36- Works_On_Essn and 37- Pno) boxes for delete')</script>";
	}
	else 
	{
		$check = "SELECT * FROM works_on WHERE (Essn LIKE '$Delete_Works_On_Essn' AND Pno = '$Delete_Pno')";
		$run = $con->query($check);
		$run = mysqli_fetch_array($run);
		if(!empty($run))
		{
			$query = " DELETE FROM works_on WHERE (Essn LIKE '$Delete_Works_On_Essn' AND Pno = '$Delete_Pno')";
			if ($con->query($query) === TRUE)
			{
		    	echo "record deleted successfully";
			}
			else
			{
			    echo "Error: " . $query . "<br>" . $con->error;
			}
		}
		else
		{
			echo "record not found";
		}
	}
}

// search Works_On
if(isset($_POST['Search_Works_On']))
{
	$Works_On_Essn = $_POST['Works_On_Essn'];
	$Pno = $_POST['Pno'];
	$Hours = $_POST['Hours'];
	if($Works_On_Essn == "" && $Pno == "" && $Hours == "")
	{
		echo "<script>alert('you should fill one of the boxes(33 to 35)')</script>";
	}
	else
	{
		$search = "SELECT * FROM works_on WHERE Essn LIKE '$Works_On_Essn' OR Pno = '$Pno' OR Hours = '$Hours'";
		$run = mysqli_query($con,$search);
		$row = mysqli_fetch_array($run);
		if(!empty($row))
		{
			echo "<br><b>Searching Works_On Table Result</b>";
			echo "<table border='1'>
			<tr>
				<th>Works_On_Essn</th>
				<th>Pno</th>
				<th>Hours</th>
			</tr>";
			echo "<tr>";
				echo "<td>" . $row['Essn'] . "</td>";
				echo "<td>" . $row['Pno'] . "</td>";
				echo "<td>" . $row['Hours'] . "</td>";
			echo "</tr>";

			while($row = mysqli_fetch_array($run))
			{
			echo "<tr>";
				echo "<td>" . $row['Essn'] . "</td>";
				echo "<td>" . $row['Pno'] . "</td>";
				echo "<td>" . $row['Hours'] . "</td>";
				
			echo "</tr>";
			}
			echo "</table>";	
		}
		else
		{
			echo "nothing found !!!";
		}
	}
}

// show Works_On Table
if (isset($_POST['Show_Works_On_tbl']))
{
	echo "<br><b>Works_On Table</b>";
	$result = mysqli_query($con,"SELECT * FROM works_on");
	echo "<table border='1'>
	<tr>
		<th>Works_On_Essn</th>
		<th>Pno</th>
		<th>Hours</th>
	</tr>";

	while($row = mysqli_fetch_array($result))
	{
	echo "<tr>";
		echo "<td>" . $row['Essn'] . "</td>";
		echo "<td>" . $row['Pno'] . "</td>";
		echo "<td>" . $row['Hours'] . "</td>";
		
	echo "</tr>";
	}
	echo "</table>";	
}

?>

		<form action="index.php" method="post">

			<!-- ***************************** Search_All ***************************** -->
			<br><br><br><br><br>
			<b>::::Search_All::::</b><br>
			38- Search All 		<input type="text" name="Search_All"><br>
			==> <input type="submit" name="Search_From_All_Tables" value="Searching a record from all tables"><br>	

		</form>

<?php

if(isset($_POST['Search_From_All_Tables']))
{
	$Search_All = $_POST['Search_All'];
	if($Search_All == "")
	{
		echo "<script>alert('you should fill the (38- Search All) box')</script>";
	}
	else
	{
		$search = "SELECT * FROM employee WHERE Fname LIKE '$Search_All' OR Minit LIKE '$Search_All' OR Lname LIKE '$Search_All' OR Ssn LIKE '$Search_All' OR Bdate = '$Search_All' OR Address LIKE '$Search_All' OR Sex LIKE '$Search_All' OR Salary = '$Search_All' OR Super_ssn LIKE '$Search_All' OR Dno = '$Search_All'";
		$run = mysqli_query($con,$search);
		$row = mysqli_fetch_array($run);
		if(!empty($row))
		{
			echo "<br><b>Searching Employee Table Result</b>";
			echo "<table border='1'>
			<tr>
				<th>Fname</th>
				<th>Minit</th>
				<th>Lname</th>
				<th>Ssn</th>
				<th>Bdate</th>
				<th>Address</th>
				<th>Sex</th>
				<th>Salary</th>
				<th>Super_ssn</th>
				<th>Dno</th>
			</tr>";
			echo "<tr>";
				echo "<td>" . $row['Fname'] . "</td>";
				echo "<td>" . $row['Minit'] . "</td>";
				echo "<td>" . $row['Lname'] . "</td>";
				echo "<td>" . $row['Ssn'] . "</td>";
				echo "<td>" . $row['Bdate'] . "</td>";
				echo "<td>" . $row['Address'] . "</td>";
				echo "<td>" . $row['Sex'] . "</td>";
				echo "<td>" . $row['Salary'] . "</td>";
				echo "<td>" . $row['Super_ssn'] . "</td>";
				echo "<td>" . $row['Dno'] . "</td>";
			echo "</tr>";

			while($row = mysqli_fetch_array($run))
			{
			echo "<tr>";
				echo "<td>" . $row['Fname'] . "</td>";
				echo "<td>" . $row['Minit'] . "</td>";
				echo "<td>" . $row['Lname'] . "</td>";
				echo "<td>" . $row['Ssn'] . "</td>";
				echo "<td>" . $row['Bdate'] . "</td>";
				echo "<td>" . $row['Address'] . "</td>";
				echo "<td>" . $row['Sex'] . "</td>";
				echo "<td>" . $row['Salary'] . "</td>";
				echo "<td>" . $row['Super_ssn'] . "</td>";
				echo "<td>" . $row['Dno'] . "</td>";
			echo "</tr>";
			}
			echo "</table>";
		}
		else
		{

			echo "<br>nothing found in employee table !!!<br>";
		}
		$search = "SELECT * FROM project WHERE Pname LIKE '$Search_All' OR Pnumber = '$Search_All' OR Plocation LIKE '$Search_All' OR Dnum = '$Search_All'";
		$run = mysqli_query($con,$search);
		$row = mysqli_fetch_array($run);
		if(!empty($row))
		{
			echo "<br><b>Searching Project Table Result</b>";
			echo "<table border='1'>
			<tr>
				<th>Pname</th>
				<th>Pnumber</th>
				<th>Plocation</th>
				<th>Dnum</th>
			</tr>";
			echo "<tr>";
				echo "<td>" . $row['Pname'] . "</td>";
				echo "<td>" . $row['Pnumber'] . "</td>";
				echo "<td>" . $row['Plocation'] . "</td>";
				echo "<td>" . $row['Dnum'] . "</td>";
				
			echo "</tr>";

			while($row = mysqli_fetch_array($run))
			{
			echo "<tr>";
				echo "<td>" . $row['Pname'] . "</td>";
				echo "<td>" . $row['Pnumber'] . "</td>";
				echo "<td>" . $row['Plocation'] . "</td>";
				echo "<td>" . $row['Dnum'] . "</td>";
				
			echo "</tr>";
			}
			echo "</table>";	
		}
		else
		{
			echo "<br>nothing found in project table !!!<br>";
		}
		$search = "SELECT * FROM department WHERE Dname LIKE '$Search_All' OR Dnumber = '$Search_All' OR Mgr_ssn LIKE '$Search_All' OR Mgr_start_date = '$Search_All'";
		$run = mysqli_query($con,$search);
		$row = mysqli_fetch_array($run);
		if(!empty($row))
		{
			echo "<br><b>Searching Department Table Result</b>";
			echo "<table border='1'>
			<tr>
				<th>Dname</th>
				<th>Dnumber</th>
				<th>Mgr_ssn</th>
				<th>Mgr_start_date</th>
			</tr>";
			echo "<tr>";
				echo "<td>" . $row['Dname'] . "</td>";
				echo "<td>" . $row['Dnumber'] . "</td>";
				echo "<td>" . $row['Mgr_ssn'] . "</td>";
				echo "<td>" . $row['Mgr_start_date'] . "</td>";
				
			echo "</tr>";

			while($row = mysqli_fetch_array($run))
			{
			echo "<tr>";
				echo "<td>" . $row['Dname'] . "</td>";
				echo "<td>" . $row['Dnumber'] . "</td>";
				echo "<td>" . $row['Mgr_ssn'] . "</td>";
				echo "<td>" . $row['Mgr_start_date'] . "</td>";
				
			echo "</tr>";
			}
			echo "</table>";	
		}
		else
		{
			echo "<br>nothing found in department table !!!<br>";
		}
		$search = "SELECT * FROM dependent WHERE Essn LIKE '$Search_All' OR Dependent_name LIKE '$Search_All' OR Sex LIKE '$Search_All' OR Bdate = '$Search_All' OR Relationship LIKE '$Search_All'";
		$run = mysqli_query($con,$search);
		$row = mysqli_fetch_array($run);
		if(!empty($row))
		{
			echo "<br><b>Searching Dependent Table Result</b>";
			echo "<table border='1'>
			<tr>
				<th>Essn</th>
				<th>Dependent_name</th>
				<th>Dependent_Sex</th>
				<th>Dependent_Bdate</th>
				<th>Relationship</th>
			</tr>";
			echo "<tr>";
				echo "<td>" . $row['Essn'] . "</td>";
				echo "<td>" . $row['Dependent_name'] . "</td>";
				echo "<td>" . $row['Sex'] . "</td>";
				echo "<td>" . $row['Bdate'] . "</td>";
				echo "<td>" . $row['Relationship'] . "</td>";

			echo "</tr>";

			while($row = mysqli_fetch_array($run))
			{
			echo "<tr>";
				echo "<td>" . $row['Essn'] . "</td>";
				echo "<td>" . $row['Dependent_name'] . "</td>";
				echo "<td>" . $row['Sex'] . "</td>";
				echo "<td>" . $row['Bdate'] . "</td>";
				echo "<td>" . $row['Relationship'] . "</td>";
				
			echo "</tr>";
			}
			echo "</table>";	
		}
		else
		{
			echo "<br>nothing found in dependent table !!!<br>";
		}
		$search = "SELECT * FROM dept_locations WHERE Dnumber = '$Search_All' OR Dlocation LIKE '$Search_All'";
		$run = mysqli_query($con,$search);
		$row = mysqli_fetch_array($run);
		if(!empty($row))
		{
			echo "<br><b>Searching dept_locations Table Result</b>";
			echo "<table border='1'>
			<tr>
				<th>Dept_Locations_Dnumber</th>
				<th>Dlocation</th>
			</tr>";
			echo "<tr>";
				echo "<td>" . $row['Dnumber'] . "</td>";
				echo "<td>" . $row['Dlocation'] . "</td>";

			echo "</tr>";

			while($row = mysqli_fetch_array($run))
			{
			echo "<tr>";
				echo "<td>" . $row['Dnumber'] . "</td>";
				echo "<td>" . $row['Dlocation'] . "</td>";
				
			echo "</tr>";
			}
			echo "</table>";	
		}
		else
		{
			echo "<br>nothing found in dept_locations table !!!<br>";
		}
		$search = "SELECT * FROM works_on WHERE Essn LIKE '$Search_All' OR Pno = '$Search_All' OR Hours = '$Search_All'";
		$run = mysqli_query($con,$search);
		$row = mysqli_fetch_array($run);
		if(!empty($row))
		{
			echo "<br><b>Searching Works_On Table Result</b>";
			echo "<table border='1'>
			<tr>
				<th>Works_On_Essn</th>
				<th>Pno</th>
				<th>Hours</th>
			</tr>";
			echo "<tr>";
				echo "<td>" . $row['Essn'] . "</td>";
				echo "<td>" . $row['Pno'] . "</td>";
				echo "<td>" . $row['Hours'] . "</td>";
			echo "</tr>";

			while($row = mysqli_fetch_array($run))
			{
			echo "<tr>";
				echo "<td>" . $row['Essn'] . "</td>";
				echo "<td>" . $row['Pno'] . "</td>";
				echo "<td>" . $row['Hours'] . "</td>";
				
			echo "</tr>";
			}
			echo "</table>";	
		}
		else
		{
			echo "<br>nothing found in works_on table !!!<br>";
		}
	}
}

?>

</body>
</html>