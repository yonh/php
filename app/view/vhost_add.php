<script src="/static/js/jquery-2.1.4.min.js"></script>
<script src="/static/js/tmpl.min.js"></script>
<script src="/static/js/underscore-min.js"></script>

<form action="/vhost_add.php" method="post">
name: <input name="name" id="name" class="config_field" /><br/>
domain_name: <input name="domain_name" id="domain_name" class="config_field"/><br/>
<!--document_root: <input name="document_root" /><br/>-->
git: <input name="git" /><br/>

<br/>
vhost config example:
<select>
<option>basic</option>
<option>normal</option>
<option>https</option>
</select><br/>
<textarea name="vhost_conf" id="vhost_conf" cols="60" rows="11">
<VirtualHost *:80>
        ServerName your_domain 
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/your_dir


        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>
</textarea>
<input value="test" type="button" onclick="replace_str()"/>
<input value="add" type="submit"/>
</form>

<script type="text/x-tmp" id="vhost_1"><VirtualHost *:80>
        ServerName {%=o.domain_name%}
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/{%=o.name%}

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost></script>

<script type="text/javascript">
var change_config = _(function() {
    name = $("#name").val()
    domain_name = $("#domain_name").val()
    var data = {'name':name, 'domain_name':domain_name}
    document.getElementById("vhost_conf").innerHTML  = tmpl("vhost_1", data);
}).debounce(100)
$(".config_field").bind('keypress', change_config)

</script>
