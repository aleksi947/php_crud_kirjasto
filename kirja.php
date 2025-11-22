<?php
include_once 'inc/header.php';
require_once 'inc/database.php';
?>

<div class="container mt-4">
  <div class="row mb-3">
    <div class="col-6">
      <h3>Kirjat</h3>
    </div>
    <div class="col-6 text-end">
      <a href="lisaa_kirja.php" class="btn btn-primary">Lisää kirja</a>
    </div>
  </div>

  <div class="row">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Nimi</th>
          <th>Kirjailija</th>
          <th>Vuosi</th>
          <th>Toiminnot</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM kirja";
        $stmt = $conn->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
        ?>
          <tr>
            <td><?= $row['kirjaID']; ?></td>
            <td><?= htmlspecialchars($row['nimi']); ?></td>
            <td><?= htmlspecialchars($row['kirjailija']); ?></td>
            <td><?= htmlspecialchars($row['vuosi']); ?></td>
            <td>
              <a class="btn btn-sm btn-secondary" href="katso_kirja.php?kirjaID=<?= $row['kirjaID']; ?>">Katso</a>
              <a class="btn btn-sm btn-warning" href="paivita_kirja.php?kirjaID=<?= $row['kirjaID']; ?>">Päivitä</a>
              <a class="btn btn-sm btn-danger" href="poista_kirja.php?kirjaID=<?= $row['kirjaID']; ?>">Poista</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include_once 'inc/footer.php';
?>
