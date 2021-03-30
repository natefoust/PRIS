<?php session_start(); ?>
<?php
  function connection()
  {
    return mysqli_connect('localhost', 'root', '', 'park');
  }

  function show_line($route)
  {

    $connection = connection();
    $query = "SELECT * FROM t_lines WHERE route=$route";
    $result = mysqli_query($connection, $query);

    echo '<table border=1>';
    echo '<tr><th>№ маршрута</th><th>Маршрут</th><th>Бортовой номер троллейбуса</th><th>Команда</th></tr>';

    while($row = mysqli_fetch_assoc($result))
    {
      echo '<form method="POST" action = "disp.php">';
        echo '<tr><td>'.$row['route'].'</td><td>'.$row['name'].'</td><td>'.$row['trail_number'].'</td>
        <td>
          <input type="hidden" name="delid" value='.$row['id'].' />
          <input type="submit" name="delete" value="Прибыл"/>
        </td>
        </tr>';
        echo '</form>';
    }

    echo '<table>';

  }

  function show_troll()
  {

    $connection = connection();
    $query = "SELECT routes.route, routes.name, trolleybuses.tail_number
                FROM routes
                INNER JOIN trolleybuses ON routes.route = trolleybuses.route_id";


    $result = mysqli_query($connection, $query);

    $query1 = "SELECT trail_number FROM t_lines";
    echo '<table border=1>';
    echo '<tr><th>№ маршрута</th><th>Маршрут</th><th>Бортовой номер</th><th>Команда</th></tr>';
    while($row = mysqli_fetch_assoc($result))
    {
      $status = 0;
      echo '<form method="POST" action = "disp.php">';
        echo '<tr><td>'.$row['route'].'</td><td>'.$row['name'].'</td><td>'.$row['tail_number'].'</td>';
        echo '<td>';
        echo '  <input type="hidden" name="route" value='.$row['route'].' />';
        echo '  <input type="hidden" name="name" value='.$row['name'].' />';
        echo '  <input type="hidden" name="num" value='.$row['tail_number'].' />';

        $result1 = mysqli_query($connection, $query1);

        while($res = mysqli_fetch_assoc($result1))
        {
          if($res['trail_number'] != $row['tail_number'])
          {
            continue;
          }
          else
          {
            $status = 1;
            break;
          }
        }

        if($status == 1)
        {
          echo 'На линии.';
        }
        else {
          echo '<input type="submit" name="throw" value="Отправить"/>';

        }
        echo '</td>';
        echo '</tr>';
        echo '</form>';

    }

    echo '<table>';

  }
 ?>
