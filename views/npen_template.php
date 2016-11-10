<div class="npen_wrapper" data-ajax="<?php echo admin_url( 'admin-ajax.php' ); ?>">
	<?php
	// получение существующих метаданных
	$data = get_post_meta( $post->ID, '_metatest_data', true );

	?>
	<label for=""> Номер ЭН <input type="text" name="metadata_field" value="<?php echo esc_attr( $data ); ?>" placeholder="ЭН" style="width: 60%;"></label>
</div>
