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

          <div class="container">
            <div class="row justify-content-center">
              <div class="col-6">
                <div class="card-body">
                  <h3 class="text-center">DEI&RTS TT Tournament 2022</h3>
                </div>
              </div>
            </div>

            <div class="container">
              <div class="row justify-content-center">
                <div class="col-6">
                  <div class="card mask-custom">
                    <div class="card-body">
                      <h4 class="text-center">Anmeldung</h4>
                      <form action="signin.php" method="post">
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                          <label for="level">Erfahrung</label>
                          <select class="form-control" name="level" id="level">
                            <option>Anfänger</option>
                            <option>Öfter gespielt</option>
                            <option>Im Verein gespielt</option>
                            <option>Aus dem weg, ich werde hier siegen</option>
                          </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Anmelden</button>
                      </form>

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
