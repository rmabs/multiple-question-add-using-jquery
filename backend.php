<?php
//this file was part of codeigniter project so ignore anything that is specific for CI like db query etc 
//but if you are php developer you will understand how to use it


    public function getresultofsurvey($id = null){

       
        $b = $this->db->query('select * from subject_survey_answer where survey_id = '.$_REQUEST['id']);
       // var_dump($this->db->last_query());
       // exit;
         if($b)
             $b = $b->result_array();
         echo json_encode($b);
    }

    public function survey(){

      
      //this function u need to ignore just use php error_reporting(0) to ignore undefined var error
        $data = null;
        $data = null;
        $data['breadcrumb'] = null;
        $campusid = $_GET['cmp'];
        $classid = $_GET['cls'];
        $subjectid = $_GET['sub'];
        
        $campusname = $this->db->query('select company from tblclients where userid ='.$campusid)->result_array();
        $campusname = $campusname[0]['company'];
        
        $classname = $this->db->query('select classname from tblcampusclasses where classid ='.$classid)->result_array();
        $classname = $classname[0]['classname'];
        $subjectname = $this->db->query('select subjectname from tblcampussubjects where subjectid ='.$subjectid)->result_array();
        $subjectname = $subjectname[0]['subjectname'];
        $create_or_update = (!isset($_GET['cont']))?_l("survey"):_l('survey');
        $breadcrumb = '<h5 class="bold">
        <a href="'.admin_url('clients/client/' . $campusid).'">'.$campusname.'</a> <span> >> </span>
        <a href="'.admin_url('clients/details/' . $campusid).'?group=classes">'.$classname.'</a> <span> >> </span>
        <a href="'.admin_url('clients/details/' . $campusid).'?group=subjects&class_name='.$classname.'&class_id='.$classid.'">'._l('subjects').'</a> <span> >> </span>
        <a href="'.admin_url('subjects/updatesubject?subjectid='.$subjectid.'&classid='.$classid.'&campusid='.$campusid).'">'.$subjectname.'</a> <span> >> </span>
        <span> '.$create_or_update.'</span>
        </h5>';
        $data['subjectid'] = $subjectid;
        $data['breadcrumb'] = $breadcrumb;
        $data['subjectname'] = $subjectname;

        $data['heading'] = isset($_GET['cont'])?_l('survey'):_l('survey');
        
        $d = $this->db->query('select * from subject_survey where subject_id = '.$subjectid)->result_array();
        $data['qs'] = $d;


        // foreach($data['qs'] as $a){
           
        //     $qt = explode('qtype=', $a['question'])[1];
        //                         $qtype = explode('andandquestionis==', $qt)[0];
                                
        //                         $ques = explode('andandquestionis==', $a['question'])[1];
        //                         $ques = explode('andandoptionsare==', $ques)[0];
                               
        //                         $options = explode('andandnextoptionsis==', $a['question']);

                                
        //                         if (str_contains($options[0], 'andandoptionsare==')) { 
                                            
        //                             $options[0] = explode('andandoptionsare==', $options[0])[1];
        //                         }
                                
        //                         $options[sizeof($options)-1] = trim($options[sizeof($options)-1]);
                                

                               
        // }
        
        $this->load->view('admin/subjects/survey', $data);
    }

    public function addsurvey(){

        
        $d = $this->db->query('insert into subject_survey (subject_id, question) values("'.$_REQUEST['sid'].'", "'.$_REQUEST['opts'].'")');
       
        if($d == true){

            echo $this->db->insert_id();
        }
        else{
            echo false;
        }
    }

    public function updatesurvey(){

        
        $d = $this->db->query('update subject_survey set question="'.$_REQUEST['opts'].'" where id='.$_REQUEST['id']);
       
        if($d == true){

            echo true;
        }
        else{
            echo false;
        }
    }

    public function deletesurvey(){
        $d = $this->db->query('delete from subject_survey where id='.$_REQUEST['id']);
       
        if($d == true){

            echo true;
        }
        else{
            echo false;
        }

    }



?>
