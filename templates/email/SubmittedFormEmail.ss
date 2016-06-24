<%-- PLACE THIS FILE IN THE TEMPLATE/email dir --%>
$Body

<% if HideFormData %>
<% else %>
	<p>
		<% loop Fields %>
			<strong><% if Title %>$Title<% else %>$Name<% end_if %></strong>
			<br />
				$FormattedValue
            <br /><br />
		<% end_loop %>
	</p>
<% end_if %>
