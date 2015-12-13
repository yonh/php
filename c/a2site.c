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

	if (argv[1] == NULL) {
		return 0;	
	} else if (strcmp("", argv[1]) == 0) {
		return 0;
	} else {
		if (strcmp("1", argv[1]) ==0) {
			system(join3("a2ensite ", argv[2]));		
		} else {
			system(join3("a2dissite ", argv[2]));		
		}
		system("service apache2 reload");
	}

	return 0;
}
/*
gcc nginx_reload.c -o nginx_reload
chown root.root nginx_reload && chmod 6755 nginx_reload
*/
