<?php
class Pengumpulan extends CI_Controller {
    function __construct()
    {
      parent::__construct();
      //checkAksesModule();
      $this->load->library('ssp');
      $this->load->model('Tugas_model');
      $this->load->database();
    }
    function data() {
    // Table name
    $table = 'tugas';
    // Primary key
    $primaryKey = 'No';
    // Columns to be displayed
    $columns = array(
        // Table column name => DataTable column name
        array('db' => 'No', 'dt' => 'No'),
        array('db' => 'nama', 'dt' => 'nama'),
        array('db' => 'kelas', 'dt' => 'kelas'),
        array('db' => 'mapel', 'dt' => 'mapel'),
        array('db' => 'materi', 'dt' => 'materi'),
        array('db' => 'file', 'dt' => 'file'),
        // Actions (edit/delete with the parameter No)
        array(
            'db' => 'No',
            'dt' => 'aksi',
            'formatter' => function ($d) {
                return anchor('pengumpulan/delete/' . $d, '<i class="fa fa-times fa fa-white"></i>', 'class="btn btn-xs btn-danger" data-placement="top" title="Delete"');
            }
        )
    );

    $sql_details = array(
        'user' => $this->db->username,
        'pass' => $this->db->password,
        'db'   => $this->db->database,
        'host' => $this->db->hostname
    );

    echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    );
}

    function index()
    {
      $this->template->load('template', 'tugas/view');
    }

    

    function add()
    {
      if (isset($_POST['submit'])) {
        $data = $_POST;
        
    // function dd($var){
    //   echo "<pre>";
    //   print_r($var);
    //   echo "</pre>";die;
    // }
    //     dd($_POST);
        $this->db->insert('tugas', $data);
        echo($_POST);
        redirect('pengumpulan');
      } else {
        $this->template->load('template', 'tugas/add');
      }
    }
    function delete()
    {
      $tugas = $this->uri->segment(3);
      if (!empty($tugas)) {
        $this->db->where('No', $tugas);
        $this->db->delete('tugas');
      }
      redirect('pengumpulan');
    }
    
}
?>