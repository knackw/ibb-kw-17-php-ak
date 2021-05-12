<?php
// Dieses html-inklude benötigt eine Variable namens $kontakte mit einem Array
// von Kontakt-Objekten der Klasse Kontakt
?>
<form method="post" >
    <input type="submit" name="new" value="neuer Kontakt" >
    <table border="1" >
        <tr>
            <th>...</th>
            <th>Id</th>
            <th>Anrede</th>
            <th>Name</th>
            <th>Anschrift</th>
            <th>PLZ/Ort</th>
            <th>Telefon</th>
        </tr>
        <?php foreach ($kontakte as $kontakt) : ?>
        <tr>
            <td>
                <button type="submit" name="old" value="<?=$kontakt->getId()?>" >bearbeiten</button>
            </td>
            <td><?=$kontakt->getId()?></td>
            <td><?= htmlspecialchars($kontakt->getAnrede())?></td>
            <td><?= htmlspecialchars($kontakt->getVorname() . ' ' . $kontakt->getNachname())?></td>
            <td><?= htmlspecialchars($kontakt->getStrasse())?></td>
            <td><?= htmlspecialchars($kontakt->getPlz() . ' ' . $kontakt->getStadt())?></td>
            <td><?= htmlspecialchars($kontakt->getTelefon())?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</form>