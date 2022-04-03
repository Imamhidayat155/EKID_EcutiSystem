<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border="1" >
		<tr>
			<th>No</th>
			<th>PIN</th>
			<th>NAMA KARYAWAN</th>
			<th>SECTION</th>
			<th style="background-color: yellow;">SISA CUTI CP</th>
		</tr>
		<?php  
		$no = 1;
		foreach ($data as $col):
			$row_jatah_CP = $this->db->get_where('v_jatah_CP_perkaryawan', array('kar_id' => $col->kar_id))->row();
            $row_potong_CP = $this->db->get_where('v_potong_CP_perkaryawan', array('kar_id' => $col->kar_id))->row();
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo ucwords($col->kar_nik) ?></td>
			<td><?php echo $col->kar_nama?></td>
			<td><?php echo $col->dep_nama?></td>
			<td><?php echo $row_jatah_CP->total - $row_potong_CP->total?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
</table>