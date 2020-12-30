<?php
$pdf=new PDF();
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
            $courses = explode(' ||| ', $school_lists[$key]['course']);
            foreach ($courses as $course) {
                $html .= '<tr>';
                $html .= '<td width="750">    -'.$course.'</td>';
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
    foreach ($score_details as $score_detail) {
        $html .= '<tr>';
        $html .= '<td width="750" align="center">'.$score_detail->subject->subject.': '.$score_detail->score.'/'.$score_detail->total.' average of '.$score_detail->average.'%</td>';
        $html .= '</tr>';
    }
    $html .= '<tr>';
    $html .= '<td width="750" align="center">Total Average: '.$userdetail->average.'%</td>';
    $html .= '</tr>';
    $html .= '</tbody>';
    $html .= '</table>';
$pdf->WriteHTML($html);
$pdf->Output();