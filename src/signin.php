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


    <section class="intro">
      <div class="bg-image h-100" style="background-image: url(tt_dark.jpg);">

        <?php
        $servername = "db";
        $username = "root";
        $password = "password";
        $dbname = "ttdb";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        $queryCreatePlayerTable = "CREATE TABLE IF NOT EXISTS `Player` (
          `ID` int(11) unsigned auto_increment,
          `NAME` varchar(255) NOT NULL default '',
          `LEVEL` varchar(255) NOT NULL default '',
          `GROUP` int(16),
          PRIMARY KEY  (`ID`)
        )";

        $conn->query($queryCreatePlayerTable);
        $name =  $_REQUEST['name'];
        $level = $_REQUEST['level'];

        $conn->query("INSERT INTO Player (Name, Level) VALUES ('$name', '$level')");

        ?>

        <div class="container">
          <div class="row justify-content-center">
            <div class="col-6">
              <div class="card-body">
                <h3 class="text-center">RTS&DEI TT Tournament 2022</h3>
              </div>
            </div>
          </div>

          <div class="mask d-flex align-items-center h-100">

            <div class="container">
              <div class="row justify-content-center">
                <div class="col-6">
                  <h4 class="text-center">Angemeldet</h4>
                  <div class="card mask-custom">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-borderless text-white mb-0 t1">
                          <thead>
                            <tr>
                              <th scope="col">Name</th>
                            </tr>
                          </thead>
                          <tbody>
                           <?php
                           $sql = "SELECT name FROM Player";
                           $result = $conn->query($sql);

                           if ($result->num_rows > 0) {
                        // output data of each row
                            while($row = $result->fetch_assoc()) {
                              echo "<tr><td>". $row["name"]. "</td></tr>";
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
      </section>
    </body>
