
<br />
<div class="container">
	<table>
		<tr class="hvmHeaderRow">
			<td>
				{$row.name} - {$row.HebrewName} - {$row.EnglishName}
				<a href="/hebrewViaMusic" title="hebrewViaMusic"><img
					src="/images/drillup.png"
				/></a>
			</td>
		</tr>
		<tr class="hvmRow">
			<td>
				{$row.Hebrew|nl2br}
			</td>
		</tr>
		<tr class="hvmRow">
			<td>
				{$row.English|nl2br}
			</td>
		</tr>
		<tr class="hvmRow">
			<td>
				{$row.translated|nl2br}
			</td>
		</tr>
	</table>
</div>
