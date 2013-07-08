
<table width="100%" height="600px">
	<tbody>
		<tr>
			<td align="center">
				<div class="grey-box wrapper-login-form ta-l">
					<div class="title blue bold fs-18"><?=$title?></div>
					<?=form_open(base_url(),array('class'=>'form-horizontal'))?>		
						<!--email-->
						<div class="control-group">
							<label class="control-label" for="email">Email</label>
							<div class="controls">
								<?=form_input($identity).form_error($identity['name'])?>
							</div>
						</div>
						
						<!--password-->
						<div class="control-group">
							<label class="control-label" for="password">Password</label>
							<div class="controls">
								<?=form_password($password).form_error($password['name'])?>
							</div>
						</div>
						
						<!--remember me-->
						<div class="control-group">
							<div class="controls">
								<label class="checkbox mb-10">
									<input type="checkbox" name="remember" id="remember"> Remember me
								</label>
								<button type="submit" class="btn btn-primary btn-large">Login</button>
							</div>
						</div>
					<?=form_close()?>
				</div>
			</td>
		</tr>
	</tbody>	
</table>	