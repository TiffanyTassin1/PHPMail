<?php
    include_once "head.php";
?>

<body>
<!-- FORMULAIRE -->

<h1>Contact</h1>
<div class="rect">
<form method="POST" action="mail.php">
<table>
<tr>
<td>Nom</td> 
<td><input type="text" name="nom" required/></td>
</tr>
<td>Prénom</td> 
<td><input type="text" name="prenom" required/></td>
</tr>
<td>E-mail</td> 
<td><input type="text" name="mail" required/></td>
</tr>
</table>

<button type="submit" name="insert"> Envoyer </button>
</form>
</div>
</body>
</html>