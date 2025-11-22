<?php

// lomakkeen kentät
$nimi = '';
$kirjailija = '';
$vuosi = '';

// virhetekstit
$nimiError = '';
$kirjailijaError = '';
$vuosiError = '';

if(!empty($_POST)){

  // luetaan lomakkeen kentät muuttujiin
  $nimi = $_POST['nimi'];
  $kirjailija = $_POST['kirjailija'];
  $vuosi = $_POST['vuosi'];

  // tietojen tarkistamista
  // oletetaan kaikki ok
  $valid = true;

  if(empty($nimi)){
    $valid = false;
    $nimiError = "Syötä kirjan nimi";
  }

  if($valid){
    // tallennetaan lomakkeen tiedot tietokantaan
    require_once 'inc/database.php';

    $sql = "INSERT INTO kirja 
            (nimi, kirjailija, vuosi)
            VALUES 
            (:nimi, :kirjailija, :vuosi)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nimi', $nimi);
    $stmt->bindParam(':kirjailija', $kirjailija);
    $stmt->bindParam(':vuosi', $vuosi);

    if($stmt->execute()){
      header("Location: kirja.php");
      exit;
    }
  }

}

  include_once 'inc/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3>Kirjan tietojen lisääminen</h3>

        <form action="" method="post">

          <div class="row mb-3">
            <label class="col-sm-3" for="nimi">Nimi</label>
            <div class="col-sm-9">
              <input  type="text"
                      value="<?= $nimi; ?>" 
                      name="nimi" 
                      class="<?=
                              (!empty($nimiError))
                              ? 'is-invalid'
                              : '';
                            ?> form-control"
              >
              <?php if(!empty($nimiError)): ?>
                <div class="invalid-feedback">
                  <small><?= $nimiError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3" for="kirjailija">Kirjailija</label>
            <div class="col-sm-9">
              <input type="text" name="kirjailija" class="form-control">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3" for="vuosi">Vuosi</label>
            <div class="col-sm-9">
              <input type="text" name="vuosi" class="form-control">
            </div>
          </div>

          <div class="col-12">
            <button class="btn btn-primary" type="submit">Tallenna</button>
            <a href="kirja.php" class="btn float-end">Takaisin</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
  include_once 'inc/footer.php';
?>
