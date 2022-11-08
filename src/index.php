<!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">


    <title>TT!</title>
  </head>
  <body>


    <!-- Grey with black text -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link disabled" href="./index.php">Übersicht</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./result.php">Ergebnis eintragen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./rules.php">Spielregeln</a>
        </li>
      </ul>
    </nav>

    <?php

    $servername = "db";
    $username = "root";
    $password = "password";
    $dbname = "ttdb";

   // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
 
      $p1 = $_REQUEST['player1'];
      $p2 = $_REQUEST['player2'];

      $strSQL = "SELECT ID FROM ttdb.Player where name='$p1'limit 1";
      $result = $conn->query($strSQL);
      $row = $result->fetch_assoc();
      $p1_id = $row['ID'];

      $strSQL = "SELECT ID FROM ttdb.Player where name='$p2'limit 1";
      $result = $conn->query($strSQL);
      $row = $result->fetch_assoc();
      $p2_id = $row['ID'];

      //check if match is duplicate
      $strSQL = "SELECT * FROM ttdb.Match_Results m where (m.Player1_id='$p1_id' and m.Player2_id='$p2_id') or (m.Player1_id='$p2_id' and m.Player2_id='$p1_id') limit 1";
      $result = $conn->query($strSQL);

      if (!$result->fetch_assoc()){

        $sets_p1 = $_REQUEST['sets_p1'];
        $sets_p2 = $_REQUEST['sets_p2'];

        $winner = $p1_id;
        if ($sets_p2 > $sets_p1)
          $winner = $p2_id;

        $points_p1 = $_REQUEST['points_p1'];
        $points_p2 = $_REQUEST['points_p2'];

        $conn->query("INSERT INTO Match_Results (Player1_id, Player2_id, Winner, Sets_p1, Sets_p2, Points_p1, Points_p2) VALUES ('$p1_id', '$p2_id', '$winner', '$sets_p1', '$sets_p2', '$points_p1', '$points_p2')");
      }
  function request_result($group_no)
  {
    return "select name, sum(CASE WHEN p.id = mr.PLAYER1_ID or p.id = PLAYER2_ID THEN 1 ELSE 0 END) as matches,
    sum(CASE WHEN mr.winner= p.id THEN 1 ELSE 0 END) as wins,
    sum(CASE WHEN mr.player1_id = p.id THEN mr.sets_p1 ELSE 0 END) + sum(CASE WHEN mr.player2_id = p.id THEN mr.sets_p2 ELSE 0 END) as setsW,
    sum(CASE WHEN mr.player1_id = p.id THEN mr.sets_p2 ELSE 0 END) + sum(CASE WHEN mr.player2_id = p.id THEN mr.sets_p1 ELSE 0 END) as setsL,
    sum(CASE WHEN mr.player1_id = p.id THEN mr.points_p1 ELSE 0 END) + sum(CASE WHEN mr.player2_id = p.id THEN mr.points_p2 ELSE 0 END) as pointsW,
    sum(CASE WHEN mr.player1_id = p.id THEN mr.points_p2 ELSE 0 END) + sum(CASE WHEN mr.player2_id = p.id THEN mr.points_p1 ELSE 0 END) as pointsL
    from Match_Results mr right join Player p
    on p.id = mr.PLAYER1_ID
    or p.id = PLAYER2_ID
    where p.group = $group_no
    group by name order by wins desc, (setsW - setsL) desc, (pointsW - pointsL) desc, name";
  }

  ?>


  <section class="intro">
    <div class="bg-image h-100" style="background-image: url(tt_dark.jpg);">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-6">
            <div class="card-body">
              <h3 class="text-center">RTS&DEI TT Tournament 2022</h3>
            </div>
          </div>
        </div>

        <div class="mask d-flex align-items-center h-50">

          <div class="container">
            <div class="row justify-content-center">
              <div class="col-6">
                <h4 class="text-center">Gruppe 1</h4>
                <div class="card mask-custom">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-borderless text-white mb-0 t1">
                        <thead>
                          <tr>
                            <th scope="col">Platz</th>
                            <th scope="col">Name</th>
                            <th scope="col">Spiele</th>
                            <th scope="col">Siege</th>
                            <th scope="col">Sätze</th>
                            <th scope="col">Punkte</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = request_result(1);
                          $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                            $row_count = $result->num_rows - 1;
                        // output data of each row
                            while($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>". ($result->num_rows - $row_count). "</td>";
                              echo "<td>". $row["name"]. "</td>";
                              echo "<td>". $row["matches"]. "</td>";
                              echo "<td>". $row["wins"]. "</td>";
                              echo "<td>". $row["setsW"]. ":". $row["setsL"]."</td>";
                              echo "<td>". $row["pointsW"]. ":". $row["pointsL"]."</td>";
                              echo "</tr>";
                              $row_count--;
                            }
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <h4 class="text-center">Gruppe 2</h4>
                <div class="card mask-custom">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-borderless text-white mb-0 t1">
                        <thead>
                          <tr>
                            <th scope="col">Platz</th>
                            <th scope="col">Name</th>
                            <th scope="col">Spiele</th>
                            <th scope="col">Siege</th>
                            <th scope="col">Sätze</th>
                            <th scope="col">Punkte</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = request_result(2);
                          $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                            $row_count = $result->num_rows - 1;
                        // output data of each row
                            while($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>". ($result->num_rows - $row_count). "</td>";
                              echo "<td>". $row["name"]. "</td>";
                              echo "<td>". $row["matches"]. "</td>";
                              echo "<td>". $row["wins"]. "</td>";
                              echo "<td>". $row["setsW"]. ":". $row["setsL"]."</td>";
                              echo "<td>". $row["pointsW"]. ":". $row["pointsL"]."</td>";
                              echo "</tr>";
                              $row_count--;
                            }
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="mask d-flex align-items-center h-50">

        <div class="container">
          <div class="row justify-content-center">
            <div class="col-6">
              <h4 class="text-center">Gruppe 3</h4>
              <div class="card mask-custom">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-borderless text-white mb-0 t1">
                      <thead>
                        <tr>
                          <th scope="col">Platz</th>
                          <th scope="col">Name</th>
                          <th scope="col">Spiele</th>
                          <th scope="col">Siege</th>
                          <th scope="col">Sätze</th>
                          <th scope="col">Punkte</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = request_result(3);
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $row_count = $result->num_rows - 1;
                        // output data of each row
                          while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>". ($result->num_rows - $row_count). "</td>";
                            echo "<td>". $row["name"]. "</td>";
                            echo "<td>". $row["matches"]. "</td>";
                            echo "<td>". $row["wins"]. "</td>";
                            echo "<td>". $row["setsW"]. ":". $row["setsL"]."</td>";
                            echo "<td>". $row["pointsW"]. ":". $row["pointsL"]."</td>";
                            echo "</tr>";
                            $row_count--;
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-6">
              <h4 class="text-center">Gruppe 4</h4>
              <div class="card mask-custom">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-borderless text-white mb-0 t1">
                      <thead>
                        <tr>
                          <th scope="col">Platz</th>
                          <th scope="col">Name</th>
                          <th scope="col">Spiele</th>
                          <th scope="col">Siege</th>
                          <th scope="col">Sätze</th>
                          <th scope="col">Punkte</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = request_result(4);
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $row_count = $result->num_rows - 1;
                        // output data of each row
                          while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>". ($result->num_rows - $row_count). "</td>";
                            echo "<td>". $row["name"]. "</td>";
                            echo "<td>". $row["matches"]. "</td>";
                            echo "<td>". $row["wins"]. "</td>";
                            echo "<td>". $row["setsW"]. ":". $row["setsL"]."</td>";
                            echo "<td>". $row["pointsW"]. ":". $row["pointsL"]."</td>";
                            echo "</tr>";
                            $row_count--;
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</body>
