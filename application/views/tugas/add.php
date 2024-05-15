<section class="content">
    <div class="row">
        <div class="col-xs-12">

          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Pengumpulan Tugas</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
                echo form_open('pengumpulan/add', 'role="form" class="form-horizontal"');
            ?>

                <div class="box-body">

                  <div class="form-group">
                      <label class="col-sm-2 control-label">No_absen</label>

                      <div class="col-sm-9">
                        <input type="number" name="No" class="form-control" placeholder="Masukan No Absen">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Nama</label>

                      <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Kelas</label>
                      <div class="col-sm-5">
                          <select name="kelas" id="tingkatan" class="form-control">
                              <option value="">Pilih Kelas</option>
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Mapel</label>
                      <div class="col-sm-5">
                          <select name="Mapel" id="Mapel" class="form-control">
                              <option value="">pilih Mapel</option>
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Materi</label>

                      <div class="col-sm-9">
                        <input type="text" name="materi" class="form-control" placeholder="materi Tugas">
                        <input type="file" name="file" id="file">
                      </div>
                  </div>

                  <div class="form-group">
                  <label class="col-sm-2 control-label">Note</label>
                      <div class="col-sm-9">
                      
                        <label class="form-control">
                        Deadline Bisa Konfirmasi Ke Guru Masing Masing 
                        </label>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-1">
                        <button type="submit" name="submit" class="btn btn-primary btn-flat">Simpan</button>
                      </div>

                      <div class="col-sm-1">
                        <?php
                          echo anchor('pengumpulan', 'Kembali', array('class'=>'btn btn-danger btn-flat'));
                        ?>
                      </div>
                  </div>

                </div>
                <!-- /.box-body -->
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<script>
$(document).ready(function() {
    // Make AJAX request to fetch data from /tingkatan/data
    $.ajax({
        url: '/pis_akademik/tingkatan/data', // URL to fetch data
        dataType: 'html',
        success: function(response) {
            // Extract JSON data from the HTML response
            var jsonData = response.match(/\{.*\}/)[0];
            
            // Parse the JSON data
            var data = JSON.parse(jsonData);

            // Check if data exists
            if (data.data) {
                // Iterate through data and append to dropdown
                $.each(data.data, function(index, item) {
                    $('#tingkatan').append('<option value="' + item.kd_tingkatan + '">' + item.nama_tingkatan + '</option>');
                });
            } else {
                // Show error message if data does not exist
                $('#tingkatan').html('<option value="">Data not available</option>');
            }
        },
        error: function(xhr, status, error) {
            // Show error message if AJAX request fails
            console.error(xhr.responseText);
            $('#tingkatan').html('<option value="">Error fetching data</option>');
        }
    });
    $.ajax({
      url: '/pis_akademik/mapel/data', // URL to fetch data
        dataType: 'html',
        success: function(response) {
            // Extract JSON data from the HTML response
            var jsonData = response.match(/\{.*\}/)[0];
            
            // Parse the JSON data
            var data = JSON.parse(jsonData);

            // Check if data exists
            if (data.data) {
                // Iterate through data and append to dropdown
                $.each(data.data, function(index, item) {
                    $('#Mapel').append('<option value="' + item.kd_mapel + '">' + item.nama_mapel + '</option>');
                });
            } else {
                // Show error message if data does not exist
                $('#Mapel').html('<option value="">Data not available</option>');
            }
        },
        error: function(xhr, status, error) {
            // Show error message if AJAX request fails
            console.error(xhr.responseText);
            $('#Mapel').html('<option value="">Error fetching data</option>');
        }
    })
});

</script>
