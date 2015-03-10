	<!--end container-->
	</div>
</body>


<!--js-->
<script src="<?=site_url('js/bootstrap.min.js')?>"></script>
<script src="<?=site_url('js/function.js')?>"></script>

<?php if(isset($scripts)){ foreach($scripts as $script){ ?>
<script src="<?=site_url($script)?>"></script>
<?php }} ?>

</html>