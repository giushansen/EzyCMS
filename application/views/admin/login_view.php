    <div id="container" >

        <?php if (validation_errors()) : ?>
        <div class="error"><?php echo validation_errors(); ?></div>
        <?php endif; ?>

    <?=form_open('admin/login');?>

    <table>
            <tr>
                <td>
                    <label for="username">Login : </label>
                </td>
                <td>
                    <input type="text" name="username" value="<?php echo set_value('username'); ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Password : </label>
                </td>
                <td>
                    <input type="password" name="password" value="<?php echo set_value('password'); ?>" />
                </td>
            </tr>
    </table>
    <br />
    <input type="submit" value="Envoyer" />

    <?=form_close();?>
    </div>