<style>
    .boutonAjouter{
        background-color: #fff; 
        padding: 10px; 
        border-radius: 10px; 
        width: 280px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        margin-bottom:20px; 
        cursor: pointer;
        display: flex;
        justify-content: center
    }
    .boutonAjouter:hover{
        background-color: #0a7b2b;
        color: white;
    }
</style>

<a href="ajouter-actualite.html" class="boutonAjouter" >
Ajouter une nouvelle actualité
</a>

<div class="card" style="width: 100%">
<h3>Liste des actualités WAGEDO</h3>

<table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Categorie</th>
        <th>Titre</th>
        <th>auteur</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
  <?php 
	include 'connexionBdd.php';
     $data = $bdd->query('SELECT * FROM actualite ORDER BY id desc');
    $u = 1;
     while ($result = $data->fetch()) {
       ?>
      <tr class="success" style="font-size: 12px" data-id="<?php echo($result['id']); ?>">
        <td width="30px"><?php echo($u); ?></td>
        <td width="100px" style="text-transform: capitalize;"><?php echo($result['categorie']); ?></td>
        <td><?php echo($result['titre']); ?></td>
        <td width="250px"><?php echo($result['auteur']); ?></td>
     <td width="100px"><?php if($result['createdAt']){ $da = explode(' ', $result['createdAt']); $d = explode('-', $da[0]); echo($d[2].'-'.$d[1].'-'.$d[0]);}  ?></td>
     <td width="100px">
      <a href=<?php echo("blog-single.html?categorie=".$result['categorie']."&titre=".$result['titre']."&id=".$result['id']) ?> style="color:blue; font-size: 15px; margin-right: 10px"><i class="bi bi-eye"></i></a>
      <span style="color:orange; font-size: 15px; margin-right: 10px"><i class="bi bi-pencil"></i></span>
      <span style="color:red; font-size: 15px;"><i class="bi bi-trash"></i></span>
     </td>
      </tr>
     <?php $u++; } $data->closeCursor(); ?> 
    </tbody>
  </table>
  
</div>
     