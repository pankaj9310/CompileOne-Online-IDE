#include <stdio.h>
int main()
{
    int t;
    scanf("%d",&t);
    while(t--)
    {
    	long long int n;
    	scanf("%lld",&n);
    	int i = n%6;
    	switch(i)
    	{
    		case 1: printf("1\n");
    				break;
    		case 3: printf("2\n");
    				break;
    		case 5: printf("3\n");
    				break;
    	}
    }
    return 0;
}
