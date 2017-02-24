 
 
 
 <?php $__env->startSection('content'); ?> 
 <div class="widget-box"> 
     <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span> 
          
     </div> 
     <div class="widget-content "> 
         <center><h3>Data Penggajian</h3> </center>
         <hr> 
         <a href="<?php echo e(url('/Penggajians/create')); ?>" class="btn btn-success"><span class="icon-plus"></span>&nbsp;&nbsp; Input data penggajian</a><hr/> 
        
          <hr>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr class="bg-danger">
                          <th><p class="center"><center>No.</center></p></th>
                          <th><p class="center"><center>Pegawai</center></p></th>
                          <th><p class="center"><center>Jumlah Jam Lembur</center></p></th>
                          <th><p class="center"><center>Jumlah Uang Lembur</center></p></p></th>
                          <th><p class="center"><center>Gaji Pokok</center></p></p></th>
                          <th><p class="center"><center>Total Gaji</center></p></p></th>
                          <th><p class="center"><center>Tanggal Pengambilan</center></p></p></th>
                          <th><p class="center"><center>Status Pengambilan</center></p></p></th>
                          <th><p class="center"><center>Petugas Penerima</center></p></p></th>
                          <th colspan="3"><p class="center"><center>Tindakan</center></p></th>
                        </tr>
                      </thead>
                            <?php 
                            $no = 1;
                             ?>
                            <?php $__currentLoopData = $gajian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody>
                                <tr>
                                    <td><?php echo e($no++); ?></td>
                                    <td><?php echo e($data->Tunjangan_pegawai->Pegawai->User->name); ?></td>
                                    <td><?php echo e($data->Jumlah_jam_lembur); ?> </td>
                                    <td><?php echo 'Rp. '.number_format($data->Jumlah_uang_lembur, 2, ",", "."); ?></td> 
                                    <td><?php echo 'Rp. '.number_format($data->Gaji_pokok, 2, ",", "."); ?></td> 
                                    <td><?php echo 'Rp. '.number_format($data->Total_gaji, 2, ",", "."); ?></td> 
                                    <td><?php echo e($data->updated_at); ?> </td>
                                    
                                    <?php if($data->Status_pengambilan == 0): ?>
                                    
                                        <td>Belum Diambil </td>
                                    <?php endif; ?>
                                    <?php if($data->Status_pengambilan == 1): ?>
                                    
                                        <td>Sudah Diambil</td>
                                    <?php endif; ?>
                                  <td><?php echo e($data->Petugas_penerima); ?> </td>
              <td><center><a href="<?php echo e(url('Penggajians', $data->id)); ?>" class="btn btn-primary">Lihat</a></center></td> 
              <td><a data-toggle="modal" href="#delete<?php echo e($data->id); ?>" class="btn btn-danger" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i>Hapus</a>
              <?php echo $__env->make('modals.del', [
              'url' => route('Penggajians.destroy', $data->id),
              'model' => $data
              ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
              </th> 
            </tr> 
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    
      </tbody> 
    </table> 
  </div> 
 </div> 
 
 
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>