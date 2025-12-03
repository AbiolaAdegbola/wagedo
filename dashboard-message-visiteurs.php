<div class="card" style="width: 100%">
<h3>Liste des message envoyés par les visiteurs WAGEDO</h3>

<table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Nom</th>
        <th>E-mail</th>
        <th>Sujet</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
  <?php 
	include 'connexionBdd.php';
     $data = $bdd->query('SELECT * FROM message_visiteur ORDER BY id desc');
    $u = 1;
     while ($result = $data->fetch()) {
       ?>
   
      <tr class="success onclickDetailModal" style="font-size: 12px" data-id="<?php echo($result['id'].'@]'."message_visiteur"); ?>">
        <td width="30px"><?php echo($u); ?></td>
        <td width="190px" style="text-transform: capitalize;"><?php echo($result['nom']); ?></td>
        <td width="20%"><?php echo($result['email']); ?></td>
        <td width="150px"><?php echo($result['titre']); ?></td>
     <td width="120px"><?php if($result['createdAt']){ $da = explode(' ', $result['createdAt']); $d = explode('-', $da[0]); echo($d[2].'-'.$d[1].'-'.$d[0]);}  ?></td>
      </tr>
      
     <?php $u++; } $data->closeCursor(); ?> 
    </tbody>
  </table>

  
</div>
     