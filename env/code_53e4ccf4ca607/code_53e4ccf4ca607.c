#include <stdio.h>
#include <string.h>

int main(void) 
{
    char name[100];
printf("Enter name");
//scanf("%s",&name);
gets(name);

puts(name);
	return 0;
}


