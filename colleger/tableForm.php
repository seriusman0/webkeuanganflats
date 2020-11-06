<?php 
    $result = mysqli_query($conn, "SELECT * FROM pengajuan ORDER BY id_pengajuan");
    $qkeperluan=mysqli_query($conn, "SELECT * FROM keperluan ORDER BY id_keperluan");
 ?>

<table class="table table-bordered">
    <tr align="center">
       <th  width="30%">Item Pengajuan</th>  
       <th width="20%">Nominal</th>
       <th width="20%">Status</th>
       <th width="30%">Aksi</th>
    </tr>
      <?php
      while($row = mysqli_fetch_array($result))
      {
      ?>
      <tr height="5%">
        <td><?php 
               $ambil = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM keperluan WHERE id_keperluan='$row[keperluan_mhs]'"));
               echo $ambil['nama_keperluan'];
              ?>
           
        </td>
        <td align="right"><?php echo rupiah($row["nominal"]); ?></td>
        <td><?php  
                                switch ($row["status"]) {
                                  case "0":
                                    echo '<i><font color="blue">Draft</font></i><br>';
                                    break;
                                  case "1":
                                    echo "Not Verified";
                                    break;
                                  case "2":
                                    echo "Verified By Shepherd";
                                    break;
                                  case "3":
                                    echo "Proccessed By Biro";
                                    break;
                                  case "4":
                                    echo "Verified";
                                    break;
                                  default:
                                    echo "Need Revision";
                                }
                        ?>
        </td>
        <td align="center">
          <input type="button" name="view" value="View" id="<?php echo $row["id_pengajuan"]; ?>"/>
          <input type="button" name="edit" value="Edit" id="<?php echo $row['id_pengajuan']; ?>" class="btn btn-warning btn-xs edit_data" />
          <input type="button" name="delete" value="Delete" id="<?php echo $row['id_pengajuan']; ?>" title="<?php echo $row['id_pengajuan']; ?>" onclick="return confirm('Apakah anda Yakin Data ini Dihapus?')" class="hapus_data"/>
          <input type="button" name="send" value="Send" id="<?php echo $row["id_pengajuan"]; ?>" title='Hapus Pengeluaran ini' onclick="return confirm('Apakah anda Yakin Data ini Dikirim?')" />
        </td>   
        </tr>
      <?php
      }
      ?>
</table>