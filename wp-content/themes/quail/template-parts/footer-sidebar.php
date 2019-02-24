<?php 
$column_class = quail_footer_column_class();
?>

<?php if ( is_active_sidebar( 'quail-footer-1' ) ) : ?>
			<div class="col <?php echo esc_attr($column_class); ?>">
				<?php dynamic_sidebar( 'quail-footer-1'); ?>
			</div>
<?php endif; ?>	

<?php if ( is_active_sidebar( 'quail-footer-2' ) ) : ?>
			<div class="col <?php echo esc_attr($column_class); ?>">
				<?php dynamic_sidebar( 'quail-footer-2'); ?>
			</div>
<?php endif; ?>	

<?php if ( is_active_sidebar( 'quail-footer-3' ) ) : ?>
			<div class="col <?php echo esc_attr($column_class); ?>">
				<?php dynamic_sidebar( 'quail-footer-3'); ?>
			</div>
<?php endif; ?>	

<?php if ( is_active_sidebar( 'quail-footer-4' ) ) : ?>
			<div class="col <?php echo esc_attr($column_class); ?>">
				<?php dynamic_sidebar( 'quail-footer-4'); ?>
			</div>
<?php endif; ?>	