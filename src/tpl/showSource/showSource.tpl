<table border="0">
	<tr>
		<td valign="top">
			<table border="0">
				{foreach from=$files item=file}
					<tr class="hvmRow">
						<td>
							<a href="/showSource?file={$file}">{$file}</a>
						</td>
					</tr>
				{/foreach}
			</table>
		</td>
		<td valign="top">
			{if $sourceFile}
				<h4>{$sourceFile}</h4>
				{$source}
			{/if}
		</td>
	</tr>
</table>
