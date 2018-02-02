<?php

?>
    <div class="col-lg-12">

        <h2>History of your messages</h2>

        <br />
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Message</th>
            </tr>
            </thead>
            <tbody>
			<?php
			$count = 1;
			foreach ($data as $message):
				?>
                <tr>
                    <th scope="row"><?=$count?></th>
                    <td><?=date('d.m.y H:i', strtotime($message['time']))?></td>
                    <td><?=$message['messages']?></td>
                </tr>
				<?php
				$count++;
			endforeach;
			?>
            </tbody>
        </table>

    </div>