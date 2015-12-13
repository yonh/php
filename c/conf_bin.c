#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdio.h>
#include<string.h>  

char* join3(char *s1, char *s2)  
{  
    char *result = malloc(strlen(s1)+strlen(s2)+1);//+1 for the zero-terminator  
    //in real code you would check for errors in malloc here  
    if (result == NULL) exit (1);  
  
    strcpy(result, s1);  
    strcat(result, s2);  
  
    return result;  
}  

int main (int argc, char *argv[])
{
	if (33 != getuid()) return 0;

	setuid (0);
    char b[4] = "def"; // char *b = "def"  
    char *c = join3("cp", b);  
	c = join3( "cp ", argv[1]);// /etc/apache2/sites-available/%s", argv[1], argv[2] );
	c = join3( c, " /etc/apache2/sites-available/");
	c = join3( c, argv[2]);
	system(c);

	// run a2ensite xxx.conf
	char *c_ensite = join3("a2ensite ", argv[2]);
	system(c_ensite);
	system("service apache2 reload");

	setuid(33);
	return 0;
}
/*
gcc nginx_reload.c -o nginx_reload
chown root.root nginx_reload && chmod 6755 nginx_reload
*/
