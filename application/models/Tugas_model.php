<?php
class Tugas_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_tugas($data) {
        $this->db->insert('tugas', $data);
        return $this->db->insert_id();
    }

    public function get_tugas($id) {
        $query = $this->db->get_where('tugas', array('id' => $id));
        return $query->row_array();
    }

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
    
    // Add more methods for database operations as needed

    public function upload_file($file) {
        $data = array(
            'filename' => $file['file_name'],
            'filetype' => $file['file_type'],
            'filedata' => file_get_contents($file['full_path'])
        );
        return $data;
    }
}
?>
