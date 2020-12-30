<?php
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',7);
	$html = '<table border=1>';
	$html .= '<tbody>';
	$html .= '<tr>';
	$html .= '<td width="750">Name: '.$user->firstname.' '.$user->lastname.'</td>';
	$html .= '</tr>';
	$html .= '<tr>';
	$html .= '<td width="750">Location: '.$user->location->city. ', Pampanga</td>';
	$html .= '</tr>';
	$html .= '<tr><td></td></tr>';
	$html .= '<tr>';
	$html .= '<td width="750">List of Recommended Schools </td>';
	$html .= '</tr>';
	$count = 0;
	foreach($school_lists as $school_list){
		$count = $count + 1;
		if ($school_list === 0) {
			$school_list = 'NONE';
			$count = '';
		}
		$html .= '<tr>';
		$html .= '<td width="750">'.$count.'. '.$school_list.'</td>';
		$html .= '</tr>';
	}
	$html .= '<tr><td></td></tr>';
	$html .= '<tr>';
	$html .= '<td width="750">List of Recommended Courses </td>';
	$html .= '</tr>';
	$count = 0;
	foreach ($suit_courses as $suit_course) {
		$count = $count + 1;
		if ($suit_course === 0) {
			$suit_course = 'NONE';
			$count = '';
		}
		$html .= '<tr>';
		$html .= '<td width="750" align="center">'.$count.'. '.$suit_course.'</td>';
		$html .= '</tr>';
	}
	$html .= '<tr><td></td></tr>';
	$html .= '<tr>';
	$html .= '<td width="750">Scores</td>';
	$html .= '</tr>';
	foreach ($score_details as $key => $score_detail) {
		$html .= '<tr>';
		$html .= '<td width="750" align="center">'.$score_detail.'/'.$number_items[$key].' average of '.round($each_average[$key]).'%</td>';
		$html .= '</tr>';
	}
	$html .= '</tbody>';
	$html .= '</table>';
$pdf->WriteHTML($html);
$pdf->Output();