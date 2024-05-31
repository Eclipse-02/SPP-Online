<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
       <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Informasi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Indicators --> 
              <ol class="carousel-indicators ind"> 
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li> 
                <li data-target="#carousel-example-generic" data-slide-to="1"></li> 
                <li data-target="#carousel-example-generic" data-slide-to="2"></li> 
              </ol> 
              <!-- Wrapper for slides --> 
              <div class="carousel-inner"> 
                <?php
                $i = 1;
                foreach ($information as $row):
                  ?>
                  <div class="item <?php echo ($i == 1) ? 'active' : ''; ?>"> 
                    <div class="row"> 
                        <div class="adjust1"> 
                            <div class="caption"> 
                              <p class="text-info lead adjust2"><?php echo $row['information_title'] ?></p>  
                              <blockquote class="adjust2"> <p><?php echo strip_tags(character_limiter($row['information_desc'], 250)) ?></p> 
                              </blockquote> 
                          </div> 
                        </div> 
                    </div> 
                  </div> 
                  <?php
                  $i++;
                endforeach;
                ?>
              </div> <!-- Controls --> 
              <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> 
                <span class="glyphicon glyphicon-chevron-left" style="font-size:20px"></span> </a> 
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> 
                  <span class="glyphicon glyphicon-chevron-right" style="font-size:20px"></span> 
                </a> 
              </div> 
            </div>

        </div>
        <!-- /.box -->
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-dollar"></i></span>

          <div class="info-box-content">
            <span class="info-box-text dash-text">Sisa Tagihan Bulanan</span>
            <span class="info-box-number"><?php echo 'Rp. ' . number_format($total_bulan, 0, ',', '.') ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

          <div class="info-box-content">
            <span class="info-box-text dash-text">Sisa Tagihan Lainnya</span>
            <span class="info-box-number"><?php echo 'Rp. ' . number_format($total_bebas-$total_bebas_pay, 0, ',', '.') ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Informasi Siswa</h3>
            <?php if ($bulan != NULL) { ?>
              <a href="<?php echo site_url('manage/payout/printBill' . '/?n=' . $bulan[0]['period_period_id'] . '&r=' . $bulan[0]['student_nis']) ?>" target="_blank" class="btn btn-danger btn-xs pull-right">Cetak Semua Tagihan</a>
            <?php } ?>
          </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-9">
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <td width="200">Tahun Ajaran</td><td width="4">:</td>
                      <?php foreach ($period as $row): ?>
                        <?php echo (isset($bulan) AND $bulan[0]['period_period_id'] == $row['period_id']) ? 
                        '<td><strong>'.$row['period_start'].'/'.$row['period_end'].'<strong></td>' : '' ?> 
                      <?php endforeach; ?>
                    </tr>
                    <tr>
                      <td>NIS</td>
                      <td>:</td>
                      <?php foreach ($siswa as $row): ?>
                        <?php echo (isset($bulan) AND $bulan[0]['student_nis'] == $row['student_nis']) ? 
                        '<td>'.$row['student_nis'].'</td>' : '' ?> 
                      <?php endforeach; ?>
                    </tr>
                    <tr>
                      <td>Nama Siswa</td>
                      <td>:</td>
                      <?php foreach ($siswa as $row): ?>
                        <?php echo (isset($bulan) AND $bulan[0]['student_nis'] == $row['student_nis']) ? 
                        '<td>'.$row['student_full_name'].'</td>' : '' ?> 
                      <?php endforeach; ?>
                    </tr>
                    <tr>
                      <td>Nama Ibu Kandung</td>
                      <td>:</td>
                      <?php foreach ($siswa as $row): ?>
                        <?php echo (isset($bulan) AND $bulan[0]['student_nis'] == $row['student_nis']) ?  
                        '<td>'.$row['student_name_of_mother'].'</td>' : '' ?> 
                      <?php endforeach; ?>
                    </tr>
                    <tr>
                      <td>Kelas</td>
                      <td>:</td>
                      <?php foreach ($siswa as $row): ?>
                        <?php echo (isset($bulan) AND $bulan[0]['student_nis'] == $row['student_nis']) ? 
                        '<td>'.$row['class_name'].'</td>' : '' ?> 
                      <?php endforeach; ?>
                    </tr>
                    <?php if (majors() == 'senior') { ?>
                      <tr>
                        <td>Rayon</td>
                        <td>:</td>
                        <?php foreach ($siswa as $row): ?>
                          <?php echo (isset($bulan) AND $bulan[0]['student_nis'] == $row['student_nis']) ? 
                          '<td>'.$row['majors_name'].'</td>' : '' ?> 
                        <?php endforeach; ?>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="col-md-3">
                <?php foreach ($siswa as $row): ?>
                  <?php if (isset($bulan) AND $bulan[0]['student_nis'] == $row['student_nis']) { ?> 
                    <?php if (!empty($row['student_img'])) { ?>
                      <img src="<?php echo upload_url('student/'.$row['student_img']) ?>" class="img-thumbnail img-responsive">
                    <?php } else { ?>
                      <img src="<?php echo media_url('img/user.png') ?>" class="img-thumbnail img-responsive">
                    <?php } 
                  } ?>
                <?php endforeach; ?>
              </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Transaksi Terakhir</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table class="table table-responsive table-bordered" style="white-space: nowrap;">
              <tr class="info">
                <th>Pembayaran</th>
                <th>Tagihan</th>
                <th>Tanggal</th>
              </tr>
              <?php 
              foreach ($log as $key) :
              ?>
              <tr>
                <td><?php echo ($key['bulan_pay_bulan_pay_id']!= NULL) ? $key['posmonth_name'].' - T.A '.$key['period_start_month'].'/'.$key['period_end_month'].' ('.$key['month_name'].')' : $key['posbebas_name'].' - T.A '.$key['period_start_bebas'].'/'.$key['period_end_bebas'] ?></td>
                <td><?php echo ($key['bulan_pay_bulan_pay_id']!= NULL) ? 'Rp. '. number_format($key['bulan_pay_bill'], 0, ',', '.') : 'Rp. '. number_format($key['bebas_pay_bill'], 0, ',', '.') ?></td>
                <td><?php echo pretty_date($key['log_trx_input_date'],'d F Y',false)  ?></td>
              </tr>
            <?php endforeach ?>

            </table>
          </div>
        </div>
      </div>

      <!-- List Tagihan Bulanan --> 
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Jenis Pembayaran</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Bulanan</a></li>
                <li><a href="#tab_2" data-toggle="tab">Bebas</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body table-responsive">
                    <table class="table table-bordered" style="white-space: nowrap;">
                      <thead>
                        <tr class="info">
                          <th>No.</th>
                          <th>Nama Pembayaran</th>
                          <th>Sisa Tagihan</th>
                          <?php foreach ($months as $key) : ?>
                            <th><?php echo $key['month_name'] ?></th>
                          <?php endforeach ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i =1;
                        foreach ($student as $r):
                          if (isset($bulan) AND $bulan[0]['student_nis'] == $r['student_nis']) {
                            ?>
                            <tr>
                              <td><?php echo $i ?></td>
                              <td><?php echo $r['pos_name'].' - T.A '.$r['period_start'].'/'.$r['period_end'] ?></td>
                              <td><?php echo ($total[$r['payment_payment_id']] == $pay[$r['payment_payment_id']]) ? 'Rp. -' : 'Rp. '.number_format($total[$r['payment_payment_id']]-$pay[$r['payment_payment_id']],0,',','.') ?></td>
                              <?php foreach ($bulan as $row) : ?>
                                <?php if ($r['payment_payment_id'] == $row['payment_payment_id']) {?>
                                    <td class="<?php echo ($row['bulan_bill'] == $row['bulan_total_pay']) ? 'success' : 'danger' ?>">
                                      <a data-toggle="modal" <?php echo $row['bulan_bill'] == $row['bulan_total_pay'] ? 'id="viewBulanCicilan'.$row['bulan_id'].'"' : "" ?> href="<?php echo $row['bulan_bill'] == $row['bulan_total_pay'] ? site_url("manage/payout/payout_bulan/".$row['payment_payment_id']."/".$row['student_student_id']."/".$row['bulan_id']) : "#addBulanCicilan".$row['bulan_id'] ?>">
                                        <?php echo ($row['bulan_bill'] == $row['bulan_total_pay']) ? '('.pretty_date($row['bulan_last_update'],'d/m/y',false).')': number_format($row['bulan_bill']-$row['bulan_total_pay'], 0, ',', '.') ?>
                                      </a>
                                    </td>
                                    <div class="modal fade" id="addBulanCicilan<?php echo $row['bulan_id'] ?>" role="dialog">
                                      <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Tambah Pembayaran/Cicilan</h4>
                                          </div>
                                          <?php echo form_open('manage/payout/payout_bulan/', array('method'=>'post')); ?>
                                          <div class="modal-body">
                                            <input type="hidden" name="bulan_id" value="<?php echo $row['bulan_id'] ?>">
                                            <input type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
                                            <input type="hidden" name="student_student_id" value="<?php echo $row['student_student_id'] ?>">
                                            <input type="hidden" name="payment_payment_id" value="<?php echo $row['payment_payment_id'] ?>">
                                            <div class="form-group">
                                              <label>Nama Pembayaran</label>
                                              <input class="form-control" readonly="" type="text" value="<?php echo $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'].' ('.$row['month_name'].')' ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Tanggal</label>
                                              <input class="form-control" readonly="" type="text" value="<?php echo pretty_date(date('Y-m-d'),'d F Y',false) ?>">
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <label>Jumlah Bayar *</label>
                                                <input type="text" required="" name="bulan_pay_bill" class="form-control numeric" placeholder="Jumlah Bayar">
                                              </div>
                                              <div class="col-md-6">
                                                <label>Keterangan *</label>
                                                <input type="text" required="" name="bulan_pay_desc" class="form-control" placeholder="Keterangan">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          </div>
                                          <?php echo form_close(); ?>
                                        </div>
                                      </div>
                                    </div>
                                  <?php } ?>
                                <?php endforeach ?>

                              </tr>
                              <?php 
                            }
                            $i++;
                          endforeach; 
                          ?>					
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab_2">
                    <!-- End List Tagihan Bulanan -->

                    <!-- List Tagihan Lainnya (Bebas) -->
                    <div class="box-body">
                      <a href="" class="btn btn-info btn-xs"><i class="fa fa-refresh"></i> Refresh</a>
                      <table class="table table-hover table-responsive table-bordered" style="white-space: nowrap;">
                        <thead>
                          <tr class="info">
                            <th>No.</th>
                            <th>Jenis Pembayaran</th>
                            <th>Total Tagihan</th>
                            <th>Dibayar</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i =1;
                          foreach ($bebas as $row):
                            if (isset($bulan) AND $bulan[0]['student_nis'] == $row['student_nis']) {
                              $sisa = $row['bebas_bill']-$row['bebas_total_pay'];
                              ?>
                              <tr class="<?php echo ($row['bebas_bill'] == $row['bebas_total_pay']) ? 'success' : 'danger' ?>">
                                <td style="background-color: #fff !important;"><?php echo $i ?></td>
                                <td style="background-color: #fff !important;"><?php echo $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'] ?></td>
                                <td><?php echo 'Rp. ' . number_format($sisa, 0, ',', '.') ?></td>
                                <td><?php echo 'Rp. ' . number_format($row['bebas_total_pay'], 0, ',', '.') ?></td>
                                <td><a href="<?php echo site_url('manage/payout/payout_bebas/'. $row['payment_payment_id'].'/'.$row['student_student_id'].'/'.$row['bebas_id']) ?>" class="view-cicilan label <?php echo ($row['bebas_bill']==$row['bebas_total_pay']) ? 'label-success' : 'label-warning' ?>"><?php echo ($row['bebas_bill']==$row['bebas_total_pay']) ? 'Lunas' : 'Belum Lunas' ?></a></td>
                              </tr>
                              <?php 
                              }
                              $i++;
                            endforeach; 
                            ?>				
                          </tbody>
                        </table> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
		<div class="row">

				
		</div>
	</section>
      
    </div>
    <div style="margin-bottom: 50px;"></div>

  </section>
  <!-- /.content -->
</div>