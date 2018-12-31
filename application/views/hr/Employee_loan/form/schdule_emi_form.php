<table class="table table-bordered">
	<thead>
		<tr>
			<th>S.No</th>
			<th>Begginng Balace</th>
			<th>Interest</th>
			<th>Principal</th>
			<th>Ending Balace</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$newPeriods = $periods;
			for ($i=0; $i < $periods; $i++) 
			{ 
				$interestPerMonth 	  = round((($loanAmount*($interest/100))/$periods), 2);

				//EMI CALCULATION
				$interestEmi          = ($interest/($periods * 100));
				$emi                  = ((($loanAmount * $interestEmi) * pow((1+$interestEmi), $newPeriods))/((pow((1+$interestEmi), $newPeriods))-1));

				$principal_amount     = round($emi-$interestPerMonth, 2);
				$endingBalance        = round($loanAmount-$principal_amount, 2);

				?>
					<tr>
						<td><?php echo $i+1;?></td>
						<td><?php echo $loanAmount;?></td>
						<td><?php echo $interestPerMonth;?></td>
						<td><?php echo $principal_amount;?></td>
						<td><?php echo $endingBalance;?></td>
					</tr>
				<?php

				$loanAmount = $endingBalance;
				$newPeriods    = $newPeriods-1;
			}
		?>


	</tbody>
</table>