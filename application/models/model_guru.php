<?php

  class Model_guru extends CI_Model
  {

    public $table = "tbl_guru";

    public function save() {
      // Upload file
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|png|pdf'; // Add more file types as needed
      $this->load->library('upload', $config);
  
      if ($this->upload->do_upload('file')) {
          $file_data = $this->upload->data();
          // Prepare data for insertion
          $data = array(
              //tabel di database => name di form
              'No' => $this->input->post('No', TRUE),
              'nama' => $this->input->post('nama', TRUE),
              'kelas' => $this->input->post('kelas', TRUE),
              'mapel' => $this->input->post('mapel', TRUE),
              'materi' => $this->input->post('materi', TRUE),
              'filename' => $file_data['file_name'],
              'filetype' => $file_data['file_type'],
              'filedata' => file_get_contents($file_data['full_path'])
          );
  
          $this->db->insert('tugas', $data);
          echo "File uploaded successfully.";
      } else {
          echo $this->upload->display_errors();
      }
  }
  

    function update()
    {
      $data = array(
        //tabel di database => name di form
        'nuptk'       => $this->input->post('nuptk', TRUE),
        'nama_guru'   => $this->input->post('nama_guru', TRUE),
        'gender'      => $this->input->post('gender', TRUE),
        'username'    => $this->input->post('username', TRUE),
        'password'    => md5($this->input->post('password', TRUE)),
        //'semester_aktif'  = $this->input->post('semester_aktif', TRUE)
      );
      $id_guru = $this->input->post('id_guru');
      $this->db->where('id_guru', $id_guru);
      $this->db->update($this->table, $data);
    }

    function login($username, $password)
    {
      $this->db->where('username', $username);
      $this->db->where('password', md5($password));
      $user = $this->db->get('tbl_guru')->row_array();
      return $user;
    }

  }

?>