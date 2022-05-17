<script type="text/javascript">
// on nomme la fenêtre pour afficher la page de retour internaute dans cette page
self.name="sitecom";

function Ouvrir_Spplus() {
	// Largeur et hauteur préconisées de la fenêtre SPPLUS
	var PopupSpplus_largeur	= 750;
	var PopupSpplus_hauteur	= 560;
	
	// Position haut et gauche de la fenêtre SPPLUS pour affichage centré dans l'écran
	var PopupSpplus_top	=((screen.height-PopupSpplus_hauteur)/2);
	var PopupSpplus_left	=((screen.width-PopupSpplus_largeur)/2);
	
	// Ouverture du popup SPLUS avec barre état uniquement et focus sur la fenêtre
	var win = window.open('', "SPPLUS","status=yes,top="+PopupSpplus_top+",left="+PopupSpplus_left+",width="+PopupSpplus_largeur+",height="+PopupSpplus_hauteur);
	win.focus();
}
</script>

<div id="content">
	<div class="full_block">
		<div id="confirm_pane">
			<div class="confirm_window">
				<h4 class="window_title">Your Order</h4>
				<div class="labels">
					<div class="cell"><?php echo Kohana::lang('account.credits') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.expiration') ?></div>
					<div class="cell"><?php echo Kohana::lang('account.total') ?></div>
				</div>
				<div class="interior">
					<div class="data">
						<div class="cell"><?php echo $order_info['credits']; ?></div>
					</div>
					<div class="data">
						<div class="cell">
							<?php
								$length = $order_info['expiry'];
								$exp_date = mktime(0, 0, 0, (date('n') + $length), date('j'), date('Y'));
								echo date('j F, Y', $exp_date);
							?>
						</div>
					</div>
					<div class="data">
						<div class="cell">&euro; <?php echo $order_info['amount']; ?></div>
					</div>
				</div>
				<div class="bottom">
					<div class="label_push">&nbsp;</div>
					<div class="bottom_note">
						<?php echo html::anchor('/subscriptions/send', Kohana::lang('subscriptions.confirm'), array('class' => 'greenButton wide', 'target' => 'SPPLUS', 'onclick' => 'Ouvrir_Spplus();')) ?>
					</div>
				</div>
			</div>
		</div>
		<div class="spplus_window">
			<img src="/media/i/spplus.jpg" alt="spplus" width="155" height="218" />
		</div>
	</div>
</div>
