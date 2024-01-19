<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Electric Tariff Calculator</title>
    <link rel="icon" type="image/x-icon" href="nasghoi-logo.png">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container">
      <div class="py-3 text-center">
        <img class="d-block mx-auto mb-0" src="./tnb-logo.PNG" alt="" width="" height="200">
        <h2>TNB Electric Tariff Calculator</h2>
        <p class="lead">The TNB Electric Tariff Calculator is a convenient and efficient tool enabling users to estimate electricity costs effortlessly. With real-time rates, it empowers individuals and businesses to make informed decisions for efficient and cost-effective energy consumption.</p>
      </div>

      <div class="row">
        <div class="col-6 col-md-4 order-md-1">
          <h4 class="mb-3">Calculate</h4>
          <form action="index.php" method="post" class="needs-validation" novalidate>
            <div class="row">
                <?php
                  $voltage = null;
                  $ampere = null;
                  $current = null;
                ?>
                <div class="col-md-12">
                    <!-- Voltage -->
                    <div class="mb-3">
                        <label for="username">Voltage</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">V</span>
                            </div>
                            <?php echo "<input type='number' class='form-control' name='voltage' placeholder='Voltage' step='0.01' value='$voltage' required>"?>
                            <div class="invalid-feedback" style="width: 100%;">
                                Enter the value as required.
                            </div>
                        </div>
                    </div>
                    <!-- Current -->
                    <div class="mb-3">
                        <label for="username">Current</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">A</span>
                        </div>
                        <?php echo "<input type='number' class='form-control' name='ampere' placeholder='Ampere' step='0.01' value='$ampere' required>"?>
                        <div class="invalid-feedback" style="width: 100%;">
                            Enter the value as required.
                        </div>
                      </div>
                    </div>
                    <!-- Current Rate -->
                    <div class="mb-3">
                        <label for="username">Current Rate</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <?php echo "<input type='number' class='form-control' name='current' placeholder='sen/kWh' step='0.01' value='$current' required>"?>
                        <div class="invalid-feedback" style="width: 100%;">
                            Enter the value as required.
                        </div>
                        </div>
                    </div>
                    <hr class="mb-3">
                    <button class="btn btn-primary btn-lg btn-block mb-3" type="submit">Calculate</button>
                    <div class="alert alert-primary" role="alert">
                      <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                          require_once 'function.php';
                          
                          $voltage = isset($_POST['voltage']) ? $_POST['voltage'] : null;
                          $ampere = isset($_POST['ampere']) ? $_POST['ampere'] : null;
                          $current = isset($_POST['current']) ? $_POST['current'] : null;
                                        
                                           
                          if ($voltage !== null && $ampere !== null) {
                            $power = calculatePower($voltage, $ampere);
                            echo "<p class='mb-0'>Power   : $power kWh</p>";
                          }

                          if ($voltage !== null && $ampere !== null)  {
                              $rate = calculateRate($current);
                              echo "<p class='mb-0'>Rate   : $rate MYR</p>";
                          }
                        
                      ?>                      
                    </div>
                </div>
            </div>
            </form>
        </div>

        <div class="col-12 col-md-8 order-md-2">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-muted">Rate Per Hour</span>
            </h4>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">Hour</th>
                    <th class="text-center" scope="col">Energy (kWh)</th>
                    <th class="text-center" scope="col">Total (RM)</th>
                  </tr>
                </thead>
                <?php

                  for ($hour = 1; $hour <= 24; $hour++) {
                      $energyPerHour = $power * $hour;
                      $totalChargePerHour = $energyPerHour * $rate;   
                ?>
                <tbody>
                <tr>
                <?php 
                    echo '<th scope="row" class="text-center">'.$hour.'</th>';
                    echo '<td class="text-center">' . number_format($energyPerHour, 5) . '</td>';
                    echo '<td class="text-center">' . number_format($totalChargePerHour, 2) . '</td>';
                 
                 }
                }
                    ?>
                </tr>
                </tbody>
              </table>    
        </div>
      </div>

      <footer class="py-5 text-muted text-center text-small">
        <p class="mb-1">&copy; nasghoi</p>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
    <script src="./js/bootstrap.js"></script>
</html>