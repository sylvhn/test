# testjavan

create file .htaccess

RewriteEngine On # Turn on the rewriting engine
RewriteRule ^api/?$ api.php [NC,L]
RewriteRule ^api/([0-9]+)/?$ api.php?id=$1 [NC,L]
RewriteRule ^api/child/([0-9]+)/?$ api.php?id=$1 [NC,L]
RewriteRule ^api/grandchild/([0-9]+)/?$ api.php?id=$1 [NC,L]
RewriteRule ^api/femalegrandchild/([0-9]+)/?$ api.php?id=$1 [NC,L]
RewriteRule ^api/malegrandchild/([0-9]+)/?$ api.php?id=$1 [NC,L]
RewriteRule ^api/malechild/([0-9]+)/?$ api.php?id=$1 [NC,L]
RewriteRule ^api/femalechild/([0-9]+)/?$ api.php?id=$1 [NC,L]
RewriteRule ^api/personwithparent/([0-9]+)/?$ api.php?id=$1 [NC,L]
