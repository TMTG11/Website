<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zoekresultatent</title>
</head>
<form id="form_zoek" class="form_zoek" method="post" action="zoeken.php">
                    	<table border="0" width="100%">
                        	<tr>
                            	<td width="250">
                                    <select name="search">
                                        <option value="voornaam">Voornaam</option>
                                        <option value="achternaam">Achternaam</option>
                                        <option value="geboortedatum">Geboortedatum</option>
                                        <option value="geboorteplaats">Geboorteplaats</option>
                                    </select>
                                </td>
                                <td width="540"><input name="zoekopdracht" type="text" placeholder="zoekopdracht"/></td>
                                <td width="150"><input name="zoeken" type="submit" value="zoeken" class="button" />
                                </td>
                            </tr>
                        </table>
                    </form>

<select name="provincie">
          <option style="color: #cccccc;">Selecteer provincie</option>
          <optgroup label="Noorden van Nederland">
          
          <option value="Groningen">Groningen</option>
          <option value="Friesland">Friesland</option>
          <option value="Drenthe">Drenthe</option>
          
          </optgroup>
          <optgroup label="Midden van Nederland">
          <option value="Noord-Holland">Noord-Holland</option>
          <option value="Flevoland">Flevoland</option>
          <option value="Overijsel">Overijssel</option>
          <option value="Gelderland">Gelderland</option>
          <option value="Utrecht">Utrecht</option>
          
          </optgroup>
          <optgroup label="Zuiden van Nederland">
          <option value="Zeeland">Zeeland</option>
          <option value="Noord-Brabant">Noord-Brabant</option>
          <option value="Limburg">Limburg</option>
          </optgroup>
        </select>


<body>
</body>
</html>
