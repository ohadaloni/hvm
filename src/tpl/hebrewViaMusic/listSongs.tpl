<div class="container">
	<table>
		<tr class="hvmHeaderRow">
			<td>#</td>
			<td>date</td>
			<td>name</td>
			<td>Hebrew</td>
			<td>English</td>
			<td>translated</td>
			<td>youtube</td>
			<td>facebook</td>
			<td>karaoke</td>
		<tr>
		{assign var=numRows value=$rows|@count}
		{foreach from=$rows key=key item=row}
			{assign var=No value=`$numRows-$key`}
			<tr class="hvmRow">
				<td>{$No}</td>
				<td>{$row.date}</td>
				<td>
					{$row.name} {$row.HebrewName} {$row.EnglishName}
				</td>
				<td>
					{$row.Hebrew|terse:2}
					{if $loginName}
						<a
							title="{$row.Hebrew}"
							href="/hebrewViaMusic/editText?id={$row.id}&fname=Hebrew"
						><img src="/images/edit.png" /></a>
					{/if}
				</td>
				<td>
					{$row.English|terse:2}
					{if $loginName}
						<a
							title="{$row.English}"
							href="/hebrewViaMusic/editText?id={$row.id}&fname=English"
						>{$row.English|terse:2}<img src="/images/edit.png" /></a>
					{/if}
				</td>
				<td>
					{$row.translated|terse:2}
					{if $loginName}
						<a
							title="{$row.translated}"
							href="/hebrewViaMusic/editText?id={$row.id}&fname=translated"
						>{$row.translated|terse:2}<img src="/images/edit.png" /></a>
					{/if}
				</td>

				<td>
					{if $row.youtube}
						<a target="_blank" href="{$row.youtube}"><img src="/images/youtube.png" /></a>
					{/if}
				</td>
				<td>
					{if $row.facebook}
						<a target="_blank" href="{$row.facebook}"><img src="/images/facebook.png" /></a>
					{/if}
				</td>
				<td>
					{if $row.karaoke}
						<a target="_blank" href="{$row.karaoke}"><img src="/images/karaoke.jpg" /></a>
					{/if}
				</td>
				<td>
					<a href="/hebrewViaMusic/show?&id={$row.id}"><img
						src="/images/list.png"
						title="Show Texts"
					/></a>
				</td>
				{if $loginName}
					<td>
						<a href="/hebrewViaMusic/edit?&id={$row.id}"><img
							src="/images/edit.png"
							title="Edit"
						/></a>
					</td>
					<td>
						<form action="/hebrewViaMusic/remove">
							<input type ="checkbox" name="ok" />
							<input type ="hidden" name="id" value="{$row.id}" />
							<input type="image" src="/images/delete.png" title="check the box to confirm deletion" />
						</form>
					</td>
				{/if}
			</tr>
		{/foreach}
	</table>
</div>
<br />
