<div class="wrap">
	<h2>Tilføj ny tabel</h2>

	<p>Opret en ny tabel, som priserne kan bindes op på</p>

	<div class="Left">
		<form method="post">
		<input type="hidden" name="AP_Form_Post" value="AddtablesFrom"> <? // denne variabel bruges til at tjekke at post kommer fra dette plugin ?>

		<table class="form-table">
			<tbody>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="Name">Shop Navn <span class="description">(påkrævet)</span></label>
					</th>
					<td>
						<input name="Name" type="text" id="Name" value="" aria-required="true" style="width: 350px;">
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<span class="spinner"></span>
			<input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Tilføj ny tabel">
		</p>

		</form>
	</div>
</div>