<?php
$pdf=new PDF();
foreach ($userdetails as $userdetail) {
    $school_lists = array();
    $suit_courses = array();
    $scores = array();
    $school_exists = false;
    foreach ($score_details as $score_detail) {
        if ($score_detail->userdetail_id == $userdetail->id) {
            foreach ($courses as $course) {
                if ($course->percentage <= $score_detail->average && $course->subject_id == $score_detail->subject_id) {
                  $suit_courses[$course->course]='';
                  if (count($school_lists) == 0) {
                    $school_lists[$course->school->school] = [
                      'course'=>$course->course.' ('.$course->subject->subject." ".$course->percentage.'%)'
                    ];
                  }else{
                    foreach ($school_lists as $value) {
                      if(isset($school_lists[$course->school->school])){
                        $school_lists[$course->school->school] = [
                          'course'=>$value['course'].' ||| '.$course->course.' ('.$course->subject->subject." ".$course->percentage.'%)'
                        ];
                        $school_exists = true;
                      }
                    }
                    if ($school_exists == false) {
                      $school_lists[$course->school->school] = [
                        'course'=>$course->course.' ('.$course->subject->subject." ".$course->percentage.'%)'
                      ];
                    }
                    $school_exists = false;
                  }
                }
            }
        $scores[] = [
            'subject' => $score_detail->subject->subject,
            'score' => $score_detail->score,
            'total' => $score_detail->total,
            'average' => $score_detail->average
        ];
        }
    }
$pdf->AddPage();
$pdf->SetFont('Arial','',7);
$image = WWW_ROOT.'img/nat.jpg';
$pdf->Image($image, 170, $pdf->GetY(), 33.78);
    $html = '<table border=0>';
    $html .= '<tbody>';
    $html .= '<tr>';
    $html .= '<td width="750">Name: '.$userdetail->user->firstname.' '.$userdetail->user->lastname.'</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td width="750">Location: '.$userdetail->user->location->city. ', Pampanga</td>';
    $html .= '</tr>';
    $html .= '<tr><td></td></tr>';
    $html .= '<tr>';
    $html .= '<td width="750">List of Recommended Schools </td>';
    $html .= '</tr>';
    $count = 1;
    foreach($school_lists as $key => $school_list){
        if ($count <= 10) {
            $school = 'true';
            $html .= '<tr>';
            $html .= '<td width="750">'.$count.'. '.$key.'</td>';
            $html .= '</tr>';
            $schools = explode(' ||| ', $school_lists[$key]['course']);
            foreach ($schools as $school) {
                $html .= '<tr>';
                $html .= '<td width="750">    -'.$school.'</td>';
                $html .= '</tr>';
            }
            $count = $count + 1;
        }
    }
    if (count($school_lists) == 0) {
        $html .= '<tr>';
        $html .= '<td width="750">NONE</td>';
        $html .= '</tr>';
    }
    $html .= '<tr><td></td></tr>';
    $html .= '<tr>';
    $html .= '<td width="750">List of Recommended Courses </td>';
    $html .= '</tr>';
    $count = 1;
    foreach ($suit_courses as $key => $suit_course) {
        if ($count <= 10) {
            $course = 'true';
            $html .= '<tr>';
            $html .= '<td width="750" align="center">'.$count.'. '.$key.'</td>';
            $html .= '</tr>';
            $count = $count + 1;
        }
    }
    if (count($suit_courses) == 0) {
        $html .= '<tr>';
        $html .= '<td width="750">NONE</td>';
        $html .= '</tr>';
    }
    $html .= '<tr><td></td></tr>';
    $html .= '<tr>';
    $html .= '<td width="750">Scores</td>';
    $html .= '</tr>';
    foreach ($scores as $score) {
        $html .= '<tr>';
        $html .= '<td width="750" align="center">'.$score['subject'].': '.$score['score'].'/'.$score['total'].' average of '.$score['average'].'%</td>';
        $html .= '</tr>';
    }
    $html .= '<tr>';
    $html .= '<td width="750" align="center">Total Average: '.$userdetail->average.'%</td>';
    $html .= '</tr>';
    $html .= '</tbody>';
    $html .= '</table>';
    $pdf->WriteHTML($html);
}
$pdf->Output();