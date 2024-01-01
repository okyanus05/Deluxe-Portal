<?php
require('functions.php');
print_header("Deluxe Portal 2.0 Installation");
?>
<div class="center"><table class="tableline" width="75%" cellspacing="1" cellpadding="4">
<tr>
<td	class="tableheader">Deluxe Portal Installation</td>
</tr>
<tr>
<td class="cellmain">Please choose one of the options below to begin the installation/upgrade process.
<ul><li><b>New Installation:</b> To install a fresh copy of Deluxe Portal, run <a href="install.php"><b>install.php</b></a>.</li>
<li><b>Upgrading from 2.0.0 Alpha 3 or later:</b> To upgrade from Deluxe Portal 2.0.0 Alpha 3 or later, run <a href="upgrade.php"><b>upgrade.php</b></a>.</li>
<li><b>Upgrading from 1.1.4 through 1.1.8:</b> To upgrade from Deluxe Portal 1.1.4 through 1.1.8, run <a href="install.php"><b>install.php</b></a>. Once install.php is complete, run <a href="import.php"><b>import.php</b></a>. Finally, you will need to run <a href="upgrade.php"><b>upgrade.php</b></li>
<li><b>Upgrading from a version below 1.1.4:</b> Please contact <a href="mailto:support@nomative.com">support@nomative.com</a> for further instructions.</li></ul>
After the installation/upgrade is complete, be sure to remove the installation directory from your server!</td>
</tr>
</table></div>
<?php
print_footer();
?>