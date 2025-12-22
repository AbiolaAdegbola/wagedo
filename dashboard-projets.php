<style>
  .boutonAjouter {
    background-color: #fff;
    padding: 10px;
    border-radius: 10px;
    width: 280px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    cursor: pointer;
    display: flex;
    justify-content: center;
  }

  .boutonAjouter:hover {
    background-color: #0a7b2b;
    color: white;
  }
</style>

<a href="ajouter-projet.html" class="boutonAjouter">
  Ajouter un nouveau projet
</a>

<div class="card" style="width: 100%">
  <h3>Liste des projets WAGEDO</h3>

  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Categorie</th>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        include 'connexionBdd.php';
        $data = $bdd->query('SELECT * FROM projets ORDER BY id DESC');
        $u = 1;
        while ($result = $data->fetch()) {
      ?>
        <tr class="success" style="font-size: 12px; cursor: normal">
          <td width="30px"><?= $u; ?></td>
          <td width="100px" style="text-transform: capitalize;"><?= htmlspecialchars($result['categorie']); ?></td>
          <td><?= htmlspecialchars($result['titre']); ?></td>
          <td width="250px"><?= htmlspecialchars($result['auteur']); ?></td>
          <td width="100px">
            <?php
              if ($result['createdAt']) {
                $da = explode(' ', $result['createdAt']);
                $d = explode('-', $da[0]);
                echo($d[2] . '-' . $d[1] . '-' . $d[0]);
              }
            ?>
          </td>
          <td width="100px">
            <a href="projet-single.html?categorie=<?= urlencode($result['categorie']); ?>&titre=<?= urlencode($result['titre']); ?>&id=<?= $result['id']; ?>" style="color:blue; font-size:15px; margin-right:10px">
              <i class="bi bi-eye"></i>
            </a>
            <!-- ✅ ajout de data-id -->
            <span class="delete_projet" data-id="<?= $result['id']; ?>" style="color:red; font-size:15px; cursor:pointer;">
              <i class="bi bi-trash"></i>
            </span>
          </td>
        </tr>
      <?php $u++; } $data->closeCursor(); ?>
    </tbody>
  </table>
</div>