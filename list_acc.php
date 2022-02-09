
  <table class="table">
  <thead>
      <tr>
          <th scope="col">id</th>
          <th scope="col">Account_name</th>
          <th scope="col">Amount</th>
      </tr>
  </thead>
  <tbody>

  <?php
    foreach ($list as $row){
                        echo  "  <tr>
                        <th scope='row'>".$row['id']."</th>
                        <td>".$row['acc_name']."</td>
                        <td>".$row['amount']."</td>
                        <td><a href='?act=delete&id=".$row['id']."' onclick='return checkDelete()'>Delete</a></td>
                        <td><a href='?act=update&id=".$row['id']."'>Update</a></td>
                       </tr>";
                        }
  
  ?>
  </tbody>
</table>
