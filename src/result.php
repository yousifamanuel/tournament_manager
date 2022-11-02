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
        <li class="nav-item">
          <a class="nav-link" href="./index.php">Übersicht</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link disabled" href="./result.php">Ergebnis eintragen</a>
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

    $queryCreatePlayerTable = "CREATE TABLE IF NOT EXISTS `Match_Results` (
      `MATCH_ID` int(11) unsigned auto_increment,
      `PLAYER1_ID` int(11) NOT NULL,
      `PLAYER2_ID` int(11) NOT NULL,
      `WINNER` int(11) NOT NULL,
      `SETS_P1` int(11) NOT NULL,
      `SETS_P2` int(11) NOT NULL,
      `POINTS_P1` int(11) NOT NULL,
      `POINTS_P2` int(11) NOT NULL,
      PRIMARY KEY  (`MATCH_ID`)
    )";

    $conn->query($queryCreatePlayerTable);

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

          <div class="container">
            <div class="row justify-content-center">
              <div class="col-8">
                <div class="card mask-custom">
                  <div class="card-body">
                    <h4 class="text-center">Ergebnis</h4>
                    <form class="text-center" action="index.php" method="post">
                     <div class="form-group">
                      <label for="player1">Spieler:in 1</label>
                      <select name="player1" id="player1">
                        <option>Spieler:in wählen</option>
                        <?php
                        $sql = "SELECT name FROM Player ORDER BY NAME";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
            // output data of each row
                          while($row = $result->fetch_assoc()) {
                            echo "<option>". $row["name"]. "</option>";
                          }
                        }
                        ?>
                      </select>
                      <select name="player2" id="player2">
                        <option>Spieler:in wählen</option>
                        <?php
                        $sql = "SELECT name FROM Player ORDER BY NAME";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
            // output data of each row
                          while($row = $result->fetch_assoc()) {
                            echo "<option>". $row["name"]. "</option>";
                          }
                        }
                        ?>
                      </select>
                      <label for="player2">Spieler:in 2</label>
                    </div>

                    <div class="form-group">
                      <label for="sets">Sätze</label>
                      <input type="number" name="sets_p1" id="sets_p1">
                      <label>:</label>
                      <input type="number" name="sets_p2" id="sets_p2">
                    </div>

                    <div class="form-group">
                      <label for="points">Punkte</label>
                      <input type="number" name="points_p1" id="points_p1">
                      <label>:</label>
                      <input type="number" name="points_p2" id="points_p2">
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Eintragen</button>
                  </form>

                </div>
              </div>
            </div>
          </div>

          <div class="mask d-flex align-items-center h-100">

          </div>
        </div>


      </div>
    </div>
  </section>
</body>
