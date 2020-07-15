{if $loginName}
	<br />
	<div class="container">
		<form method="post" action="/hebrewViaMusic/insert">
			<table>
				<tr class="hvmHeaderRow">
					<td colspan="2">
						Add a hebrewViaMusic song
						<a href="/hebrewViaMusic" title="hebrewViaMusic"><img
							src="/images/drillup.png"
						/></a>
					</td>
				</tr>
				<tr class="hvmRow">
					<td>name</td>
					<td>
						<input type="text" size="50" name="name" />
					</td>
				</tr>
				<tr class="hvmRow">
					<td colspan="2">
						<button class="btn btn-large btn-primary" type="submit">Add</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
{/if}
