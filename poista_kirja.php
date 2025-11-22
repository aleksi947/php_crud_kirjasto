<?php
require_once 'inc/database.php';

if(!empty($_POST)){

  $kirjaID = intval($_POST['kirjaID']);

  $sql = "DELETE FROM kirja 
          WHERE kirjaID = :kirjaID";
  
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':kirjaID', $kirjaID);
  
  if($stmt->execute()){
    header("Location: kirja.php");
    exit;
  }

}else {

  $kirjaID = intval($_GET['kirjaID']) ?? null;

  if(!is_int($kirjaID)){
    header("Location: kirja.php");
    exit;
  }

  $sql = "SELECT nimi
          FROM kirja
          WHERE kirjaID = :kirjaID";

  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':kirjaID', $kirjaID);
  $stmt->execute();

  if($stmt->rowCount() != 1){
    header("Location: kirja.php");
    exit;
  }

  $kirja = $stmt->fetch();

}

include_once 'inc/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">

        <h3>Kirjan poistaminen</h3>
        <p>Haluatko varmasti poistaa kirjan, <?= $kirja['nimi']; ?>?</p>

        <form action="poista_kirja.php" method="post">
          <input type="hidden" name="kirjaID" value="<?= $kirjaID ;?>">

          <button type="submit" class="btn btn-danger">Poista</button>
          <a href="kirja.php" class="btn float-end">Takaisin</a>

        </form>
      </div>
    </div>
  </div>
</div>

<?php
include_once 'inc/footer.php';
?>
