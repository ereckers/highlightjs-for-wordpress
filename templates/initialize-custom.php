<script>
$(document).ready(function() {
	$('<?php echo $this->settings['custom_selector']; ?>').each(function(i, e) {hljs.highlightBlock(e)});
});
</script>
