<?php 
	require_once(__DIR__."/../../core/ViewManager.php");
	require_once(__DIR__."/../../model/WORKDAY_model.php");
	$view = ViewManager::getInstance();
	$wdMapper = new WorkdayMapper();
	$schedules = $view->getVariable("schedules");
	$data = $view->getVariable("scheduledata");
?>

<script>

	$(document).ready(function() {

		$('#calendario').fullCalendar({
			defaultView: 'agendaWeek',
    		firstDay: 1,
    		allDay: false,
			defaultDate: '<?= date('Y/m/d') ?>',
			editable: false,
			events: [
				//xornadas de traballo
				<?php foreach ($schedules as $sc): ?>
					<?php 
						$begin = new DateTime( $sc->getDateStart() );
						$end = new DateTime( $sc->getDateEnd() );

						$interval = DateInterval::createFromDateString('1 day');
						$period = new DatePeriod($begin, $interval, $end);
					?>
					<?php foreach ($period as $p): ?>
						<?php 
							$time = strtotime($p->format('Y/m/d'));
	        				$dayoweek = date('N',$time);
	        				$dayoweek = $dayoweek - 1;
							$wd= $wdMapper->getScheduleWorkday($sc->getIdSchedule(), $dayoweek);
						 ?>
						
						{
							start: '<?=$p->format('Y-m-d') ?>T<?=$wd->getHourStart()  ?>',
							end: '<?=$p->format('Y-m-d') ?>T<?=$wd->getHourEnd()  ?>',
							rendering: 'background'
						},
					<?php endforeach ?>					
				<?php endforeach ?>

				<?php foreach ($data as $session): ?>
					{
						title: '<?=$session->getActivity()->getActivityname() ?>',
						start: '<?= $session->getHourStart() ?>',
						end: '<?=$session->getHourEnd()  ?>',
						color: '<?=$session->getActivity()->getColor() ?>'
					},
				<?php endforeach ?>

			]
		});
		
	});

</script>
 


<div class="col-xs-12" style="margin-top: 20px; margin-bottom: 20px">
		<div id='calendario' ></div>
	</div>