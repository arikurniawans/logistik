<?php

class Auth_model extends CI_Model
{
    var $users = "users";

    public function logged_in()
    {
        return $this->session->userdata('id');
    }


    //fungsi check login
    public function check_login($data){
		$username = $data['username'];
        $password = $data['password'];		

        $cek = $this->db->get_where($this->users,array(
            'username' => $username
        ))->num_rows();
        $result = $this->db->get_where($this->users,array(
            'username'=>$username
        ))->result();

        if ($cek != 0){

            $pass_hash = $result[0]->password;

            if (password_verify($password,$pass_hash)){
					
                $hakAkses = $result[0]->id_personel;
                $session['id'] = $result[0]->id_personel;
                $session['nama'] = $result[0]->nama;
                $session['pangkat'] = $result[0]->pangkat;
                $session['nrp'] = $result[0]->nrp;
                $session['no_telpon'] = $result[0]->no_telpon;
                $session['user_status'] = $result[0]->user_status;


                $this->session->set_userdata($session);
                if($result[0]->user_status == 'admin'){
                    redirect('dashboard');
                }else if($result[0]->user_status == 'personel' || $result[0]->user_status == 'pimpinan'){
                    redirect('dashboard');
                }
                
            }else{
                $this->session->set_flashdata("error1","failpassword");
                redirect('auth');
            }

        } else{
            $this->session->set_flashdata("error2","failaccount");
            redirect('auth');
        }
    }

    public function editPass($id, $data)
    {
        $this->db->where('id_personel',$id);
        $this->db->update('users',$data);
        return true;
    }

    public function isNotLogin(){
        return $this->session->userdata('id') === null;
    }

    public function isNotAccess(){
        $resrole = $this->db->get_where('role_management',array(
            'nrp' => $this->session->userdata('nrp')
        ))->result();

        if($resrole[0]->menus == "dashboard" AND $resrole[0]->role == "F"){
            return true;
        }

        // foreach($resrole as $data){
        //     if($data->menus == "dashboard" AND $data->role == "F"){
        //         return "Tes";
        //     }else if($data->menus == "suratmasuk" AND $data->role == "F"){
        //         return "Tes";
        //     }else if($data->menus == "suratkeluar" AND $data->role == "F"){
        //         return "Tes";
        //     }else if($data->menus == "laporansuratmasuk" AND $data->role == "F"){
        //         return "Tes";
        //     }else if($data->menus == "laporansuratkeluar" AND $data->role == "F"){
        //         return "Tes";
        //     }
        // }
    }

}