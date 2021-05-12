<form method="post">
    <button type="submit" name="back">zurück</button><br>
    <input type="text" name="id" placeholder="Id" value="<?=$kontakt->getId()?>" readonly ><br>
    <input type="text" name="anrede" placeholder="Anrede" value="<?=$kontakt->getAnrede()?>" ><br>
    <input type="text" name="vorname" placeholder="Vorname" value="<?=$kontakt->getVorname()?>" ><br>
    <input type="text" name="nachname" placeholder="Nachname" value="<?=$kontakt->getNachname()?>" ><br>
    <input type="text" name="strasse" placeholder="Strasse" value="<?=$kontakt->getStrasse()?>" ><br>
    <input type="text" name="plz" placeholder="Plz" value="<?=$kontakt->getPlz()?>" ><br>
    <input type="text" name="stadt" placeholder="Stadt" value="<?=$kontakt->getStadt()?>" ><br>
    <input type="text" name="telefon" placeholder="Telefon" value="<?=$kontakt->getTelefon()?>" ><br>
    <input type="submit" name="save" value="Speichern" >
    <input type="submit" name="delete" value="Löschen - OHNE Rückfrage !!!" >
</form>
<p>
    <?=$message?>
</p>