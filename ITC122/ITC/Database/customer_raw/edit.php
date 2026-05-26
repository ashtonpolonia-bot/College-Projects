<?php include '../db.php';

$ID = $_GET['ID'];

$stmt = $conn->prepare("SELECT * FROM customer_raw WHERE ID = :ID");
$stmt->execute([':ID' => $ID]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Title = $_POST['Title'];
    $LastName = $_POST['LastName'];
    $FirstName = $_POST['FirstName'];
    $MiddleName = $_POST['MiddleName'];
    $SuffixName = $_POST['SuffixName'];
    $DateOfBirth = $_POST['DateOfBirth'];
    $AddressLine01 = $_POST['AddressLine01'];
    $AddressLine02 = $_POST['AddressLine02'];
    $Barangay = $_POST['Barangay'];
    $City = $_POST['City'];
    $Province = $_POST['Province'];
    $Region = $_POST['Region'];
    $Contact = $_POST['Contact'];
    $Email = $_POST['Email'];
    $Status = $_POST['Status'];
    $CreatedAt = $_POST['CreatedAt'];
    $UpdatedAt = $_POST['UpdatedAt'];



    $stmt = $conn->prepare("UPDATE customer_raw SET Title=:Title, LastName=:LastName, FirstName=:FirstName, MiddleName=:MiddleName, SuffixName=:SuffixName, DateOfBirth=:DateOfBirth, AddressLine01=:AddressLine01, AddressLine02=:AddressLine02, Barangay=:Barangay, City=:City, Province=:Province, Region=:Region, Contact=:Contact, Email=:Email, Status=:Status, CreatedAt=:CreatedAt, UpdatedAt=:UpdatedAt  WHERE ID=:ID");
    $stmt->execute([
        ':Title' => $Title,
        ':LastName' => $LastName,
        ':FirstName' => $FirstName,
        ':MiddleName' => $MiddleName,
        ':SuffixName' => $SuffixName,
        ':DateOfBirth' => $DateOfBirth,
        ':AddressLine01' => $AddressLine01,
        ':AddressLine02' => $AddressLine02,
        ':Barangay' => $Barangay,
        ':City' => $City,
        ':Province' => $Province,
        ':Region' => $Region,
        ':Contact' => $Contact,
        ':Email' => $Email,
        ':Status' => $Status,
        ':CreatedAt' => $CreatedAt,
        ':UpdatedAt' => $UpdatedAt,
        ':ID' => $ID
    ]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h2>Edit Customer</h2>

<form method="POST">
     <h6>Title</h6>
    <input class="form-control mb-2" name="Title" value="<?php echo $row['LastName']; ?>">
    <h6>Last Name</h6>
    <input class="form-control mb-2" name="LastName" value="<?php echo $row['LastName']; ?>">
     <h6>First Name</h6>
    <input class="form-control mb-2" name="FirstName" value="<?php echo $row['FirstName']; ?>">
     <h6>Middle Name</h6>
    <input class="form-control mb-2" name="MiddleName" value="<?php echo $row['MiddleName']; ?>">
     <h6>Suffix Name</h6>
    <input class="form-control mb-2" name="SuffixName" value="<?php echo $row['SuffixName']; ?>">
     <h6>Date Of Birth</h6>
    <input class="form-control mb-2" name="DateOfBirth" value="<?php echo $row['DateOfBirth']; ?>">
     <h6>Address Line 01</h6>
    <input class="form-control mb-2" name="AddressLine01" value="<?php echo $row['AddressLine01']; ?>">
     <h6>Address Line 02</h6>
    <input class="form-control mb-2" name="AddressLine02" value="<?php echo $row['AddressLine02']; ?>">
     <h6>Barangay</h6>
    <input class="form-control mb-2" name="Barangay" value="<?php echo $row['Barangay']; ?>">
     <h6>City</h6>
    <input class="form-control mb-2" name="City" value="<?php echo $row['City']; ?>">
     <h6>Province</h6>
    <input class="form-control mb-2" name="Province" value="<?php echo $row['Province']; ?>">
     <h6>Region</h6>
    <input class="form-control mb-2" name="Region" value="<?php echo $row['Region']; ?>">
     <h6>Contact</h6>
    <input class="form-control mb-2" name="Contact" value="<?php echo $row['Contact']; ?>">
     <h6>Email</h6>
    <input class="form-control mb-2" name="Email" value="<?php echo $row['Email']; ?>">
     <h6>Status</h6>
    <input class="form-control mb-2" name="Status" value="<?php echo $row['Status']; ?>">
     <h6>Created</h6>
    <input class="form-control mb-2" name="CreatedAt" value="<?php echo $row['CreatedAt']; ?>">
     <h6>Updated</h6>
    <input class="form-control mb-2" name="UpdatedAt" value="<?php echo $row['UpdatedAt']; ?>">
    <button class="btn btn-warning">Update</button>
</form>

</body>
</html>