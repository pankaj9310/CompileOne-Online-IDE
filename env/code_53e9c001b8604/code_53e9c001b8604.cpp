#include <iostream>
using namespace std;

int main() {
	int n=4;
	int arr[n+2];
	for(int i=0;i<n;i++)
	    cin>>arr[i];
	int max=-1;
	for(int i=0;i<n;i++)
	{
	       if(arr[i]>max)
	       max=arr[i];
	}
	cout<<max<<endl;
	return 0;
}
