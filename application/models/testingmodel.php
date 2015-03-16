<?php
class Testingmodel extends CI_Model {
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getrandomfirstname() {
        $string = read_file('./assets/files/firstnames.csv');
        $fnames = explode(chr(10), $string);
        shuffle($fnames);
        return $fnames[0];
    }

    function getrandomlastname() {
        $string = read_file('./assets/files/lastnames.csv');
        $lnames = explode(chr(10), $string);
        shuffle($lnames);
        return $lnames[0];
    }
    
    function getrandomplace(){
        $string = read_file('./assets/files/cities.csv');
        $places = explode(chr(10),$string);
        shuffle($places);
        return $places[0];
    }
    
     function deleteexaminees() {
        $this->db->empty_table('examinees');
    }
    
    function deleteresults() {
        $this->db->empty_table('results');
    }
    
     function gentestexaminees() {
         
        for ($x = 1; $x < 11; $x++) {
            $fname = $this->getrandomfirstname();
            $lname = trim($this->getrandomlastname());
            $dob = rand('1940','1985') . '-' . rand('1','12') . '-' . rand('1','30');
            $randdate = time()+rand(-15,15)*24*60*60;
            $examdate = date('Y-m-d', $randdate);
            $regnum = random_string('numeric', 16);
            $email = $lname . "@mail.com";
            $exam = $this->rand_exam();
            $inviglist = $this->invigilatormodel->listinvigilators();
            foreach($inviglist as $row){
                $invigids[]=$row['id'];
            }
            shuffle($invigids);
            $invigid = $invigids[0];
            $this->examineemodel->addexaminee($fname, $lname, $dob, $examdate, $regnum, $email, $exam,$invigid);
        }
    }
    
    function deleteinvigilators() {
        $this->db->empty_table('invigilators');
    }

     function gentestinvigilators() {
         //echo "hello from gentestinvigilators model";
        $citylist=array("Vancouver","Surrey","Prince George","Kelowna","Coquitlam");
        for ($x = 1; $x < 11; $x++) {
            $place = $this->getrandomplace();
            $placearray = explode(",",$place);
            $fname = $this->getrandomfirstname();
            $lname = $this->getrandomlastname();
            $username = $fname . trim($lname);
            $password = random_string('alnum', 8);
            $email = $lname . "@mail.com";
            $city = $placearray[0];
            $province = $placearray[1];
            $country = $placearray[2];
            $institution = 'institution ' . random_string('numeric', 2);
            $contact = "this is contact info " . $this->rand_string();
            $this->invigilatormodel->addinvigilator($fname, $lname, $email ,$city, $province,$country,$institution, $username, $contact, $password);
        }
    }
    
    function rand_exam() {
        $rand = rand(0, 3);
        $exams = array("Acupuncturist", "Herbalist","Reciprocity","Doctor of TCM");
        $exam = $exams[$rand];
        return $exam;
    }

    function rand_string() {
        $rand = rand(3, 10);
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $str = substr(str_shuffle($chars), 0, $rand);
        return $str;
    }

    
//     function generateexamquestions() {
//        $this->deleteexamques();
//        $examtype = array("IPC", "RISK", "Accupuncture", "Herbology");
//        for ($y = 0; $y < 4; $y++) {
//            $xname = $examtype[$y];
//            for ($x = 1; $x < 121; $x++) {
//                $qnum = $x;
//                $qdiff=rand(5,10) * 10;
//                $examname = $xname;
//                $qtext = "This is ".$xname.  " question " . $x . " difficulty " . $qdiff;
//                $r1 = "This is response 1 for ques " . $x;
//                $r2 = "This is response 2 for ques " . $x;
//                $r3 = "This is response 3 for ques " . $x;
//                $r4 = "This is response 4 for ques " . $x;
//
//                $this->exammodel->addexamques($qnum, $examname, $qtext, $r1, $r2, $r3, $r4,$qdiff);
//            }
//        }
    

//    function deleteexamques() {
//        $this->db->empty_table('examques');
//    }

    
}
?>
