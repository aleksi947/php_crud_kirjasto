<?php

require_once 'inc/database.php';

if (!empty($_POST)) {

  // luetaan lomakkeen kentät muuttujiin
  $kirjaID = $_POST['kirjaID'];
  $nimi = $_POST['nimi'];
  $kirjailija = $_POST['kirjailija'];
  $vuosi = $_POST['vuosi'];

  // oletetaan, että käyttäjä syöttänyt kaikki kentät
  $valid = true;

  if (empty($nimi)) {
    $valid = false;
    $nimiError = "Syötä kirjan nimi";
  }

  if (empty($kirjailija)) {
    $valid = false;
    $kirjailijaError = "Syötä kirjailija";
  }

  if ($valid) {
    // päivitetään tiedot tietokantaan

    $sql = "UPDATE kirja
            SET nimi = :nimi, 
                kirjailija = :kirjailija, 
                vuosi = :vuosi
            WHERE kirjaID = :kirjaID";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':kirjaID', $kirjaID);
    $stmt->bindParam(':nimi', $nimi);
    $stmt->bindParam(':kirjailija', $kirjailija);
    $stmt->bindParam(':vuosi', $vuosi);

    if ($stmt->execute()) {
      header("Location: kirja.php");
      exit;
    }
  }
} else {

  $kirjaID = intval($_GET['kirjaID']) ?? null;

  if (is_null($kirjaID)) {
    header("Location: kirja.php");
    exit;
  }

  $sql = "SELECT * 
          FROM kirja
          WHERE kirjaID = :kirjaID";

  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':kirjaID', $kirjaID);
  $stmt->execute();

  if ($stmt->rowCount() != 1) {
    header("Location: kirja.php");
    exit;
  }

  $kirja = $stmt->fetch(PDO::FETCH_OBJ);

  // lomakkeen kentät
  $nimi = $kirja->nimi;
  $kirjailija = $kirja->kirjailija;
  $vuosi = $kirja->vuosi;

  // virhetekstit
  $nimiError = '';
  $kirjailijaError = '';
  $vuosiError = '';
 
}

include_once 'inc/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3 class="mb-3">Kirjan tietojen päivittäminen</h3>

        <form action="paivita_kirja.php" method="post" class="needs-validation" novalidate>
          <input type="hidden" name="kirjaID" value="<?= $kirjaID; ?>">

          <div class="row mb-3">
            <label class="col-sm-3" for="nimi">Nimi</label>
            <div class="col-sm-9">
              <input type="text"
                name="nimi"
                class="<?=
                        (!empty($nimiError))
                          ? 'is-invalid'
                          : '';
                        ?> form-control"
                value="<?= $nimi; ?>"
                required>
              <?php if (!empty($nimiError)): ?>
                <div class="invalid-feedback">
                  <small><?= $nimiError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3" for="kirjailija">Kirjailija</label>
            <div class="col-sm-9">
              <input required
                type="text"
                value="<?= $kirjailija; ?>"
                name="kirjailija"
                class="form-control <?= (!empty($kirjailijaError)) ? 'is-invalid' : ''; ?>">
              <?php if (!empty($kirjailijaError)): ?>
                <div class="invalid-feedback">
                  <small><?= $kirjailijaError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3" for="vuosi">Vuosi</label>
            <div class="col-sm-9">
              <input required
                type="text"
                name="vuosi"
                class="<?= (!empty($vuosiError)) ? 'is-invalid' : ''; ?> form-control"
                value="<?= $vuosi; ?>">
              <?php if (!empty($vuosiError)): ?>
                <div class="invalid-feedback">
                  <small><?= $vuosiError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="col-12">
            <button class="btn btn-primary" type="submit">Päivitä</button>
            <a href="kirja.php" class="btn float-end">Takaisin</a>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<script>
  (() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')

    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>

<?php
include_once 'inc/footer.php';
?>
