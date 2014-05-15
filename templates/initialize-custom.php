<script>
$(document).ready(function() {
	$('<?php echo $options['custom_selector']; ?>').each(function(i, e) {hljs.highlightBlock(e)});
});
</script>
