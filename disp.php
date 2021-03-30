<?php session_start(); ?>
<?php
$name = $_POST['name'];
if($name)
{
  header('Location: /disp.php');
}
include("functions.php");
if(isset($_POST['auth_subm']))
{
  if(!empty($_POST['auth_login']) && !empty($_POST['auth_password']))
  {
    $login = $_POST['auth_login']; $password = $_POST['auth_password'];

    $connection = connection();
    $query = "SELECT * FROM dispetchers WHERE login = '$login' AND password = '$password'";
    $result = mysqli_query($connection, $query);
    // Check if query return 0 lines -> there are no such disp in database
    $result = mysqli_fetch_assoc($result);
    $_SESSION['name'] = $result['name'];
    $_SESSION['position'] = $result['position'];

  }
}
?>


<html>
<head>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>

  <div class="maininfo">
    <h2><?php
     echo $_SESSION['name'];    ?><h2>
    <h3><?php echo $_SESSION['position']; ?>
  </div>

<div class="main">

<section>
  <div class="info">
    <?php
    show_troll();
    ?>
  </div>
</section>

<section>
  <div class="lines" align="center" >
    <h3> Маршрут 1 </h3>
    <?php show_line(1); ?>
    <h3> Маршрут 2 </h3>
    <?php show_line(2); ?>
  </div>
</section>

</div>
</body>
</head>


<?php
if(isset($_POST['delete']))
{
  $id = $_POST['delid'];
  unset($_POST);
  $connection = connection();
  $query = "DELETE FROM t_lines WHERE id=$id";

  $result = mysqli_query($connection, $query);

}

if(isset($_POST['throw']))
{

  $route = $_POST['route'];
  $name = $_POST['name'];
  $num = $_POST['num'];
  unset($_POST);
  $connection = connection();
  $query = "INSERT INTO t_lines(route, name, trail_number) VALUES('$route', '$name', '$num')";

  $result = mysqli_query($connection, $query);

}
?>
