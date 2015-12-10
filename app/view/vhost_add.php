<?php include 'header.php'; ?>

<form action="/vhost_add.php" method="post" class="ice-form">
    <div>
        <label class="ice-form-label">name</label>
        <input name="name" id="name" class="config_field" />
    </div>
    
    <div>
        <label class="ice-form-label">domain_name</label>
        <input name="domain_name" id="domain_name" class="config_field"/>
    </div>
    
    <div>
        <label class="ice-form-label">git</label>
        <input name="git" />
    </div>
    
    <div class="ice-onerow">
        <label class="ice-form-label">config example</label>
        <label><input type="radio" value="vhost_basic" name="config_example" checked />basic</lable>
        <label><input type="radio" value="vhost_rewrite" name="config_example" />rewrite</lable>
    </div>
    
    <div>
        <label class="ice-form-label">config</label>
        <textarea name="vhost_conf" id="vhost_conf" style="height:260"></textarea>
    </div>

    <div class="ice-div">
        <label class="ice-form-label"></label>
        <button class="ice-button-red">Save</button>
        <button type="button">Cancel</button>
    </div>

</form>

<script type="text/x-tmp" id="vhost_basic"><VirtualHost *:80>
    ServerName {%=o.domain_name%}
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/{%=o.name%}

    ErrorLog ${APACHE_LOG_DIR}/{%=o.name%}.error.log
    CustomLog ${APACHE_LOG_DIR}/{%=o.name%}.access.log combined
</VirtualHost></script>
<script type="text/x-tmp" id="vhost_rewrite"><VirtualHost *:80>
    ServerName {%=o.domain_name%}
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/{%=o.name%}
    
    <Directory /var/www/{%=o.name%}>
        AllowOverride All
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/{%=o.name%}.error.log
    CustomLog ${APACHE_LOG_DIR}/{%=o.name%}.access.log combined
</VirtualHost></script>

<script type="text/javascript">
var change_config = _(function() {
    tmpl_name = $('input[name="config_example"]:checked ').val();
    name = $("#name").val()
    domain_name = $("#domain_name").val()
    var data = {'name':name, 'domain_name':domain_name}
    document.getElementById("vhost_conf").innerHTML  = tmpl(tmpl_name, data);
}).debounce(100)
$(".config_field").bind('keypress', change_config)
$("input[name='config_example']").bind('change', change_config)

$(document).ready(function() {
    change_config();
})




</script>
