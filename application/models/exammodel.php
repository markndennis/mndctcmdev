<?php

class Exammodel extends CI_Model {

    function __construct() {

//        // Call the Model constructor
        parent::__construct();
    }

    function addexamques($qnum, $examname, $qtext, $r1, $r2, $r3, $r4, $qdiff) {
        $datetime = date('Y-m-d H:i:s', time());
        $data = array(
            'qnum' => trim($qnum),
            'examname' => trim($examname),
            'qtext' => trim($qtext),
            'r1' => trim($r1),
            'r2' => trim($r2),
            'r3' => trim($r3),
            'r4' => trim($r4),
            'difficulty' => $qdiff,
            'created' => $datetime,
            'active' => 'Y',
        );
        $this->db->insert('examques', $data);
    }

    function getprofile($pname) {
        $this->db->from('examprofile');
        $this->db->where('profilename', $pname);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getexamtime($pname) {
        switch ($pname) {
            case "Acupuncturist":
                $t = 90;
                break;
            case "Herbalist":
                $t = 90;
                break;
            case "Reciprocity":
                $t = 45;
                break;
            case "Doctor of TCM":
                $t = 45;
                break;
        }
        return $t;
    }

    function getexamques($subtest, $numques) {
        // returns a given number of a shuffled array of exam questions for a given subtest
        $this->db->from('examques');
        $this->db->where('subtest', $subtest);
        $query = $this->db->get();
        $query = $query->result_array();
        //foreach($query as $row){echo $row['id'];}
        $result = shuffle($query);
        $result = array_slice($query, 0, $numques);
//        foreach ($result as $row) {
//            echo $row['id'] . ",";
//        }
        return $result;
    }

    function testdifficulty($result, $target, $range) {
        // tests the difficulty of a shuffled array of exam questions
        $arraysum = 0;
        foreach ($result as $row) {
            //echo $row['targetdifficulty'];
            $arraysum = $arraysum + $row['difficulty'];
        }

        $arraycount = count($result);
        $arrayavg = $arraysum / $arraycount;
        if ($arrayavg > ($target - $range) && $arrayavg < ($target + $range)) {
            return $arrayavg;
        } else {
            return FALSE;
        }
    }

    function quesseq($result) {
        $qseq = "";
        foreach ($result as $row) {
            $qseq = $qseq . $row['id'] . ",";
        }

        //$qseq = rtrim($qseq,",");

        return $qseq;
    }

    function postqseq($id, $qseq) {
        $data = array('qseq' => $qseq);

        $this->db->where('id', $id);
        $this->db->update('examinees', $data);
    }

    function listexamquestionsns() {
        $this->db->from('examques');
        $this->db->limit(101);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getques($id) {
        $this->db->where('id', $id);
        $ques = $this->db->get('examques');
        return $ques->result_array();
    }

    function getallques() {
        $ques = $this->db->get('examques');
        return $ques->result_array();
    }

    function buildquesarray($qseq) {
        $quesarray = array();
        $qidarray = explode(",", $qseq);

        foreach ($qidarray as $row) {
            $ques = $this->getques($row);
            array_pop($ques[0]);
            //echo var_dump($ques);
            foreach ($ques as $qrow) {
                array_push($quesarray, $qrow);
            }
        }
        //echo var_dump($quesarray);
        return $quesarray;
    }

      function scoreexam($id) {
        $this->db->where('examineeid', $id);
        $results = $this->db->get('results');
        $results = $results->result_array();
		$examinee = $this->examineemodel->getexaminee($id);
		$examprofile = $examinee[0]['examprofile'];

        $correct = 0;
        $na = 0;
        $incorrect = 0;

        foreach ($results as $row) {
            $soln = $this->getques($row['qid']);
            // echo $row['answer'];
            //echo $soln[0]['solution'];
            if ($row['answer'] === $soln[0]['solution']) {
                $correct = $correct + 1;
                //echo "correct";
            } elseif ($row['answer'] === 'NA') {
                $na = $na + 1;
                //echo "na";
            } else {
                $incorrect = $incorrect + 1;
                //echo "incorrect";
            }
		}
        
        $score['correct'] = $correct;
        $score['na'] = $na;
        $score['incorrect'] = $incorrect;
		if ($examprofile == 'Acupuncturist' || $examprofile == 'Herbalist'){
			if ($correct / ($na + $incorrect + .0001) > .6999) {
				$score['passfail'] = 'pass';
			} else {
				$score['passfail'] = 'fail';
			}
		}else{
			if ($correct / ($na + $incorrect + .0001) > .4999) {
				$score['passfail'] = 'pass';
			} else {
				$score['passfail'] = 'fail';
			}
		}
        return $score;
    }
	
    function getresults($id) {
        //echo $id;
        $this->db->where('examineeid', $id);
        $query = $this->db->get('results');
        $results = $query->result_array();
        $i = -1;
        foreach ($results as $row) {
            $i++;
            $results[$i]['qnum'] = $i + 1;
            $soln = $this->getques($row['qid']);
            $results[$i]['soln'] = $soln[0]['solution'];
        }

        return $results;
    }

}

?>
