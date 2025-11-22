<?php

  require_once 'inc/database.php';

  $kirjaID = intval($_GET['kirjaID']) ?? null;

  if(is_null($kirjaID)){
    header("Location: kirja.php");
    exit;
  }

  $sql = "SELECT * 
          FROM kirja
          WHERE kirjaID = :kirjaID";
  
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':kirjaID', $kirjaID);
  $stmt->execute();

  if($stmt->rowCount() != 1){
    header("Location: kirja.php");
    exit;
  }

  $kirja = $stmt->fetch(PDO::FETCH_OBJ);


  include_once 'inc/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3 class="mb-3">Kirjan tietojen katsominen</h3>

        <form>

          <div class="row mb-3">
            <label class="col-sm-3" for="nimi">Nimi</label>
            <div class="col-sm-9">
              <input type="text" value="<?= $kirja->nimi; ?>" class="form-control">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3" for="kirjailija">Kirjailija</label>
            <div class="col-sm-9">
              <input type="text" value="<?= $kirja->kirjailija; ?>" class="form-control">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3" for="vuosi">Vuosi</label>
            <div class="col-sm-9">
              <input type="text" value="<?= $kirja->vuosi; ?>" class="form-control">
            </div>
          </div>

          <div class="col-12">
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
