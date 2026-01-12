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

<a href="ajouter-info-a-la-une.html" class="boutonAjouter" >
Ajouter une nouvelle info à la une
</a>

<div class="card" style="width: 100%">
<h3>Liste des informations à la une WAGEDO</h3>

<table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>auteur</th>
        <th>informations</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
  <?php 
	include 'connexionBdd.php';
     $data = $bdd->query('SELECT * FROM alaune ORDER BY id desc');
    $u = 1;
     while ($result = $data->fetch()) {
       ?>
   
      <tr class="success onclickDetailModal" style="font-size: 12px" data-id="<?php echo($result['id'].'@]'."alaune"); ?>">
        <td width="30px"><?php echo($u); ?></td>
        <td width="190px" style="text-transform: capitalize;"><?php echo($result['auteur']); ?></td>
        <td width="20%"><?php echo($result['titre']); ?></td>
        <td width="120px"><?php if($result['createdAt']){ $da = explode(' ', $result['createdAt']); $d = explode('-', $da[0]); echo($d[2].'-'.$d[1].'-'.$d[0]);}  ?></td>
      </tr>
      
     <?php $u++; } $data->closeCursor(); ?> 
    </tbody>
  </table>
 
  <script type="text/javascript">
    $('.onclickDetail').on('click', function(e){
        
    e.preventDefault()

    var element = $(this).data('id')
    
    let url = "blog-single.html"

    $.ajax({
      type: 'POST',
      url: url,
      data: {modalDetail: el},
      success: function(response) {
        // $('.contentModal').html(response); 
        // $('#dashboardDevisModal').modal('show')
      }
    });

  })
</script>
  
</div>
     