
	<?php if ($data): ?>
	<?php foreach ($data as $key => $value): ?>
		<h5><?=$value['question']?>?</h5>
		<?php if ($value['answer']): ?>
			<p class="ans-bubble"><?=$value['answer']?></p>
			<?php else: ?>
			<p class="ans-bubble">No answer yet...</p>
		<?php endif ?>
	<?php endforeach ?>
	<?php endif ?>