<div id="left">

    <h1>Contactez-nous des maintenant</h1>
    
    <div id="switch">
        <img class="image" id="imap" src="<?=$sBaseUrl?>images/webincrease.jpg"
alt="contact_web" width="575" height="300" />

        <div id="gmap">
            <iframe width="575" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=21+Rue+de+Crim%C3%A9e,+75019+Paris&amp;sll=47.349965,2.194684&amp;sspn=0.008156,0.022724&amp;ie=UTF8&amp;hq=&amp;hnear=21+Rue+de+Crim%C3%A9e,+75019+Paris,+Ile-de-France&amp;ll=48.882949,2.389011&amp;spn=0.016933,0.049267&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
        </div>
    </div>

    <h2>Parlons ensemble de votre projet</h2>

    <p>Vous avez la possibilit&eacute; de nous joindre et de nous faire part de vos intentions, remarques ou encore questions.</p>

    <?=form_open('Contact/Contact_Insert');?>

    <table>
        <tbody>
            <tr>
                <td></td>
                <td colspan="2" align="center">
                    <h3>Renseignements :</h3>
                </td>
                <td>
                </td>
                <td>
                    <h3>Votre projet en quelques mots :</h3>
                </td>
            </tr>
            <tr>
                <td><span class="ui-icon ui-icon-home"></span></td>
                <td>
                    <label for="name">Nom de la soci&eacute;te : </label>
                </td>
                <td>
                    <input type="text" name="name" width="200px"/>
                </td>
                <td rowspan="3" width="50px">
                </td>
                <td rowspan="3" align="center">
                    <textarea name="project" rows="10"></textarea>
                </td>
            </tr>
            <tr>
                <td><span class="ui-icon ui-icon-mail-closed"></span></td>
                <td>
                    <label for="email">Courrier &eacute;lectronique : </label>
                </td>
                <td>
                    <input type="text" name="email" />
                </td>
            </tr>
            <tr>
                <td><span class="ui-icon ui-icon-calculator"></span></td>
                <td>
                    <label for="phone">Num&eacute;ro de t&eacute;l&eacute;phone : </label>
                </td>
                <td>
                    <input type="text" name="phone" />
                </td>
            </tr>
        </tbody>
    </table>

    <input type="submit" value="Envoyer" />

    <?=form_close();?>

</div>
<div id="right">

    <div class="box">
        <div class="boxHead ui-corner-top">
            <h2> Les news Loulou </h2>
        </div>
        <div class="boxContent">
            <p> Voici un exemple de boite ou des news vont apparaitrent ... </p>
        </div>
        <div class="boxFooter ui-corner-bottom">
        </div>
    </div>
    
</div>
