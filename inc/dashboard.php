<?php
function enx_admin_dashboard($setting)
{
?>
    <div class="wrap" style="margin-top:0px;">
        <h1 style="padding:0px"><!--This is to fix promo--></h1>
        <table cellpadding="2" cellspacing="1" width="100%" class="fixed" border="0">
            <tbody>
                <tr>
                    <td valign="top">
                        <h1 class="wp-heading-inline">Tripgo API Setting</h1>
                    </td>
                    <td align="right" width="40"><a target="_blank" href="https://twitter.com/tripgo"><img src="https://tripgoplugin.enixindo.com/wp-content/plugins/pagelayer/images/twitter.png"></a></td>
                    <td align="right" width="40"><a target="_blank" href="https://www.facebook.com/tripgo/"><img src="https://tripgoplugin.enixindo.com/wp-content/plugins/pagelayer/images/facebook.png"></a></td>
                </tr>
            </tbody>
        </table>
        <hr />
        <h4>API Key</h4>
        <form method="POST">
            <table>
                <tbody>
                    <tr>
                        <td scope="row">API Key</td>
                        <td><input type="text" value="<?php echo $setting->api_key ?>" name="api_key" /></td>
                    </tr>
                    <tr>
                        <td scope="row">Secret Key</td>
                        <td><input type="text" value="<?php echo $setting->secret_key ?>" name="secret_key" /></td>
                    </tr>
                </tbody>
            </table>
            <p><button type="submit" class="button button-primary">Save</button></p>
        </form>
        <hr />
        <h4>Style</h4>
        <form method="POST">
            <table>
                <tbody>
                    <tr>
                        <td scope="row">API Key</td>
                        <td><input type="text" value="<?php echo $setting->api_key ?>" name="api_key" /></td>
                    </tr>
                    <tr>
                        <td scope="row">Secret Key</td>
                        <td><input type="text" value="<?php echo $setting->secret_key ?>" name="secret_key" /></td>
                    </tr>
                </tbody>
            </table>
            <p><button type="submit" class="button button-primary">Save</button></p>
        </form>
        <p>Test</p>
    </div>
<?php
}
