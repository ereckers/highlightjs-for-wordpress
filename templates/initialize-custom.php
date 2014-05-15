<script>
$(document).ready(function() {
	$('<?php echo $custom_selector; ?>').each(function(i, e) {hljs.highlightBlock(e)});
});
</script>
