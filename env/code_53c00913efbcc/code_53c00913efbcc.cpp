#include <iostream>
#include<algorithm>
#include<stdlib.h>
using namespace std;

int main() 
{
	// your code goes here
	long int n,p,a,b,flag;
	long long int k,index=0;
	cin>>n>>k>>p;
	long long int arr[n],arr1[n],start[n],end[n];
	for(long int i=0;i<n;i++)
	{
	   cin>>arr[i];
	   arr1[i]=arr[i];
	   start[i]=0;
	   end[i]=0;
	}
	sort(arr1,arr1+n);
	start[index]=0;
	for(long int i=0;i<n-1;i++)
	{
	    if(abs(arr1[i]-arr1[i+1])<=k)
	    {}
	    else
	    {
	        end[index]=i;
	        index++;
	        start[index]=i+1;
	    }
	}
	end[index]=n-1;
	//cout<<"\n\n"<<index<<"\n"<<start[index]<<" "<<end[index];
	while(p--)
	{
	   cin>>a>>b;
	   a=a-1;
	   b=b-1;
	   flag=0;
	   for(long int i=0;i<=index;i++)
	   {
	       if(arr[a]>=arr1[start[i]]&&arr[b]<=arr1[end[i]])
	       {
	           cout<<"Yes\n";
	           flag=1;
	           break;
	       }
	   }
	   if(flag!=1)
	      cout<<"No\n";
	}
	return 0;
}