<table border="0" cellpadding="0" cellspacing="0"
	style="margin: auto; width: 412px;">
	<tr>
		<th colspan="2"><img width="412"
			src="<?=base_url()?>public/images/logo-informe.jpg" /></th>
	</tr>
	<tr>
		<th
			style="font-family: Helvetica; padding: 20px; border: 1px solid #f6f6f6; color: #555555;">Tipo
			Evento</th>
		<td
			style="font-family: Helvetica; padding: 20px; border: 1px solid #f6f6f6; text-align: center; color: #555555;"><?=$tipoEvento?></td>
	</tr>
	<tr>
		<th
			style="font-family: Helvetica; padding: 20px; border: 1px solid #f6f6f6; color: #555555;">Evento</th>
		<td
			style="font-family: Helvetica; padding: 20px; border: 1px solid #f6f6f6; text-align: center; color: #555555;"><?=$evento?></td>
	</tr>
	<tr>
		<td colspan="2"
			style="font-family: Helvetica; text-align: center; border: 1px solid #f6f6f6;">
			<p
				style="text-align: center; font-weight: bold; padding: 20px 10px 10px; color: #555555;">Descripci&oacute;n</p>
			<p
				style="text-align: justify; padding: 0px 10px 10px; color: #555555;"><?=$descripcion?></p>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table align="center" width="412" cellpadding="0" cellspacing="0">
				<tr>
					<th
						style="text-align: center; font-weight: bold; font-family: Helvetica; border: 1px solid #f6f6f6; padding: 20px 10px 10px; color: #555555;">Imagen</th>
				</tr>
				<tr>
					<th style="border: 1px solid #f6f6f6;"><img
						src="<?=base_url()?>public/images/app/<?=$imagen?>"
						style="width: 100%;" /></th>
				</tr>
			</table>
			<table align="center" width="412" cellpadding="0" cellspacing="0">
				<tr>
					<th
						style="text-align: center; font-weight: bold; font-family: Helvetica; border: 1px solid #f6f6f6; padding: 20px 10px 10px;"><a
						style="color: #2478cb"
						href="https://www.google.com/maps/search/?api=1&query=<?=$latitud?>,<?=$longitud?>"
						target="_blank">Ubicaci&oacute;n (Ir)</a></th>
				</tr>
				<tr>
					<th style="border: 1px solid #f6f6f6;"><img
						src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$latitud?>,<?=$longitud?>&markers=color:red%7Clabel:%7C<?=$latitud?>,<?=$longitud?>&zoom=10&size=396x280&key=AIzaSyA5KK1NXguxeDyOoOWgEv1n8BW2KifMl4A"
						style="width: 100%;" /></th>
				</tr>
			</table>
		</td>
	</tr>
</table>