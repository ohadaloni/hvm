
<br />
<div class="container">
	<form method="get" action="/hebrewViaMusic/update">
		<table>
			<tr class="hvmHeaderRow">
				<td>
					Change {$row.name} {$fname}
					<a href="/hebrewViaMusic" title="hebrewViaMusic"><img
						src="/images/drillup.png"
					/></a>
				</td>
			</tr>
			<tr class="hvmRow">
				<td>
					<textarea rows="30" cols="80" name="{$fname}">{$row.$fname}</textarea>
				</td>
			</tr>
			<tr class="hvmRow">
				<td colspan="2">
					<input type="hidden" name="id" value="{$row.id}" />
					<button class="btn btn-large btn-primary" type="submit">Update</button>
				</td>
			</tr>
		</table>
	</form>
</div>
