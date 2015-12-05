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

	// run a2dissite xxx.conf and rm config file
	char *c_dissite = join3("a2dissite ", argv[1]);
	system(c_dissite);
	char *c_rmconf = join3("rm -f /etc/apache2/sites-available/", argv[1]);
	system(c_rmconf);
	system("service apache2 reload");

	setuid(33);
	return 0;
}
/*
gcc nginx_reload.c -o nginx_reload
chown root.root nginx_reload && chmod 6755 nginx_reload
*/
