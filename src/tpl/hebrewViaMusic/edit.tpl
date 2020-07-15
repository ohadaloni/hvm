
<br />
<div class="container">
	<form method="get" action="/hebrewViaMusic/update">
		<table>
			<tr class="hvmHeaderRow">
				<td colspan="2">
					Change a hebrewViaMusic row
					<a href="/hebrewViaMusic" title="hebrewViaMusic"><img
						src="/images/drillup.png"
					/></a>
				</td>
			</tr>
			<tr class="hvmRow">
				<td>
					date
				</td>
				<td>
					<input type="date" name="date" value="{$row.date}" />
				</td>
			</tr>
			<tr class="hvmRow">
				<td>
					name
				</td>
				<td>
					<input type="text" size="50" name="name" value="{$row.name}" />
				</td>
			</tr>
			<tr class="hvmRow">
				<td>
					HebrewName
				</td>
				<td>
					<input type="text" size="50" name="HebrewName" value="{$row.HebrewName}" />
				</td>
			</tr>
			<tr class="hvmRow">
				<td>
					EnglishName
				</td>
				<td>
					<input type="text" size="50" name="EnglishName" value="{$row.EnglishName}" />
				</td>
			</tr>
			<tr class="hvmRow">
				<td>
					facebook
				</td>
				<td>
					<input type="text" size="50" name="facebook" value="{$row.facebook}" />
				</td>
			</tr>
			<tr class="hvmRow">
				<td>
					youtube
				</td>
				<td>
					<input type="text" size="50" name="youtube" value="{$row.youtube}" />
				</td>
			</tr>
			<tr class="hvmRow">
				<td>
					karaoke
				</td>
				<td>
					<input type="text" size="50" name="karaoke" value="{$row.karaoke}" />
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
